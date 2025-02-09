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
    ];

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
}
