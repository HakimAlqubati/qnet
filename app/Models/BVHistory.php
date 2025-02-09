<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BVHistory extends Model
{
    use HasFactory;

    protected $table = 'bv_history';

    protected $fillable = [
        'user_id',
        'direction',
        'bv_value',
        'description',
    ];

    // Define direction constants
    public const DIRECTION_IN = 'right';
    public const DIRECTION_OUT = 'left';

    // Get direction labels
    public static function getDirectionLabels(): array
    {
        return [
            self::DIRECTION_IN => 'Right',
            self::DIRECTION_OUT => 'Left',
        ];
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
