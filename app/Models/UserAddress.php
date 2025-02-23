<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'address1',
        'address2',
        'city_id',
        'district_id'
    ];

    /**
     * Get the user that owns the UserAddress.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the city that owns the UserAddress.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the district that owns the UserAddress.
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
