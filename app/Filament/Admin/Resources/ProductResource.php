<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductTag;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use League\Csv\Writer;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';
    protected static ?string $navigationGroup = 'Products & Categories';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Wizard::make()->columnSpanFull()->skippable()
                    ->schema([
                        Step::make('basicData')->schema([
                            Fieldset::make()->schema([
                                Grid::make()->columns(3)->schema([
                                    Forms\Components\TextInput::make('name')
                                        ->required()
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('price')
                                        ->required()
                                        ->numeric()
                                        ->prefix('$'),
                                    Forms\Components\TextInput::make('bv')->label('BV')
                                        ->required()
                                        ->numeric()
                                        ->prefix('%'),
                                ]),
                                Forms\Components\Select::make('category_id')
                                    ->label('Category')
                                    ->options(ProductCategory::all()->pluck('name', 'id'))
                                    ->searchable(),
                                Forms\Components\TextInput::make('inventory_count')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0),
                                Forms\Components\TextInput::make('low_stock_threshold')
                                    ->required()
                                    ->numeric()
                                    ->minValue(0)
                                    ->label('Low Stock Threshold'),
                                Forms\Components\Select::make('tags')
                                    ->multiple()
                                    ->relationship('tags', 'name')
                                    ->preload(),
                                Forms\Components\Textarea::make('description')->columnSpanFull()
                                    ->maxLength(65535),
                            ])
                        ]),
                        Step::make('images')->schema([
                            SpatieMediaLibraryFileUpload::make('images')
                                ->disk('public')
                                ->label('')
                                ->directory('products')
                                ->columnSpanFull()
                                ->image()
                                ->multiple()
                                ->fetchFileInformation()
                                ->downloadable()
                                ->moveFiles()
                                ->previewable()
                                ->imagePreviewHeight('250')
                                ->loadingIndicatorPosition('right')
                                ->panelLayout('integrated')
                                ->removeUploadedFileButtonPosition('right')
                                ->uploadButtonPosition('right')
                                ->uploadProgressIndicatorPosition('right')
                                ->panelLayout('grid')
                                ->reorderable()
                                ->openable()
                                ->downloadable(true)
                                ->previewable(true)
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                    return (string) str($file->getClientOriginalName())->prepend('product-');
                                })
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->imageEditorMode(2)
                                ->imageEditorEmptyFillColor('#fff000')
                                ->circleCropper()

                        ])
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->striped()->defaultSort('id', 'desc')
            ->columns([
                SpatieMediaLibraryImageColumn::make('')->label('images')->size(50)
                    ->circular()->alignCenter(true)->getStateUsing(function () {
                        return null;
                    })->limit(3),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('price')->money('usd')->sortable()->alignCenter(true),
                Tables\Columns\TextColumn::make('category.name')->searchable()->sortable()->alignCenter(true),
                Tables\Columns\TextColumn::make('inventory_count')->sortable()->alignCenter(true),
                // Tables\Columns\TagsColumn::make('tags.name'),
            ])
            // ->filters([
            //     Tables\Filters\SelectFilter::make('category')
            //         ->relationship('category', 'name'),
            // ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('adjustInventory')
                    ->label('Adjust Inventory')
                    ->icon('heroicon-o-adjustments-horizontal')
                    ->action(function (Product $record, array $data): void {
                        $record->inventory_count += $data['adjustment'];
                        $record->save();

                        // InventoryLog::create([
                        //     'product_id' => $record->id,
                        //     'quantity_change' => $data['adjustment'],
                        //     'reason' => $data['reason'],
                        // ]);
                    })
                    ->form([
                        Forms\Components\TextInput::make('adjustment')
                            ->label('Quantity Adjustment')
                            ->required()
                            ->integer(),
                        Forms\Components\TextInput::make('reason')
                            ->label('Reason for Adjustment')
                            ->required(),
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('export')
                    ->label('Export Selected')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn(Collection $records) => static::export($records)),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    protected static function export(Collection $records)
    {
        $csv = Writer::createFromString('');

        $csv->insertOne(['Name', 'SKU', 'Category', 'Price', 'Inventory Count', 'Low Stock Threshold', 'Status']);

        foreach ($records as $record) {
            $csv->insertOne([
                $record->name,
                $record->sku,
                $record->category->name,
                $record->price,
                $record->inventory_count,
                $record->low_stock_threshold,
                $record->inventory_count > $record->low_stock_threshold ? 'In Stock' : ($record->inventory_count > 0 ? 'Low Stock' : 'Out of Stock'),
            ]);
        }

        $filename = 'inventory_report_' . date('Y-m-d') . '.csv';
        $path = storage_path('app/public/' . $filename);
        file_put_contents($path, $csv->getContent());

        return response()->download($path)->deleteFileAfterSend();
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->count();
    }
}
