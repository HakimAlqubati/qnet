<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plan',
        'from_date',
        'to_date',
        'active',
        'created_by',
    ];

    /**
     * Relationship with User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get active plans.
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    // Automatically fill 'created_by' when creating a new record
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($userPlan) {
            if (Auth::check()) {
                $userPlan->created_by = Auth::id();
            }
        });
    }
}
