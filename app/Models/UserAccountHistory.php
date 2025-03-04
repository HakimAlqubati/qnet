<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserAccountHistory extends Model
{
    use HasFactory;

    protected $table = 'user_account_history';
    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'notes'
    ];

    // Constants for type values
    public const TYPE_INCREASE = 'increase';
    public const TYPE_DECREASE = 'decrease';

    // Get type labels
    public static function getTypeLabels(): array
    {
        return [
            self::TYPE_INCREASE => 'Increase',
            self::TYPE_DECREASE => 'Decrease',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Boot method to auto-save created_by
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (!$model->created_by && Auth::check()) {
                $model->created_by = Auth::id();
            }
        });
    }
}