<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rank extends Model
{
    use HasFactory;

    protected $table = 'ranks';

    protected $fillable = [
        'name',
        'level',
        'minimum_points',
        'benefits',
        'type',
    ];

    // ✅ Define Constants for Rank Types
    public const TYPE_SALARY = 'salary';
    public const TYPE_TEAM = 'team';

    /**
     * Accessor to decode benefits if stored as JSON.
     */
    public function getBenefitsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }


    /**
     * Scope: Filter ranks by type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }


    // 🔹 Get Badge Color Based on Type
    public static function getBadgeColor(string $type): string
    {
        return match ($type) {
            self::TYPE_SALARY => 'success',
            self::TYPE_TEAM => 'warning',
            default => 'gray',
        };
    }

        // 🔹 Map Labels for Types
        public static function getRankTypes(): array
        {
            return [
                self::TYPE_SALARY => __('Salary Ranks'),
                self::TYPE_TEAM => __('Team Ranks'),
            ];
        }
    
        // 🔹 Get Icon Based on Type
        public static function getTypeIcon(string $type): string
        {
            return match ($type) {
                self::TYPE_SALARY => 'heroicon-o-currency-dollar',
                self::TYPE_TEAM => 'heroicon-o-users',
                default => 'heroicon-o-question-mark-circle',
            };
        }
}
