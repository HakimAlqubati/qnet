<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CategoryResource\Pages;
use App\Filament\Admin\Resources\CategoryResource\RelationManagers;
use App\Models\ProductCategory;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Products & Categories';
    protected static ?string $modelLabel = "Category";

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Fieldset::make()->columns(2)->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            Forms\Components\Select::make('parent_category_id')
                                ->relationship('parent', 'name'),
                            Forms\Components\RichEditor::make('description')->columnSpanFull(),
                             FileUpload::make('image')
                                ->disk('public')
                                ->label('')
                                ->directory('categories')
                                ->columnSpanFull()
                                ->image()
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
                                 
                                ->reorderable()
                                ->openable()
                                ->downloadable(true)
                                ->previewable(true)
                                ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                                    return (string) str($file->getClientOriginalName())->prepend('category-');
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
        return $table->striped()
            ->columns([
                ImageColumn::make('image_url')->label('Image')->circular(),
                Tables\Columns\TextColumn::make('name')->searchable()
                    ->label(__('Name')),
                Tables\Columns\TextColumn::make('parent.name'),
                Tables\Columns\TextColumn::make('products_count')->alignCenter(true)
                    ->counts('products')
                    ->label(__('Total Products'))
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()->count();
    }
}
