<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserIdentity extends Model
{
    
    protected $fillable = ['user_id', 'identity_id', 'value'];

    // One-to-One relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // One-to-One relation with IdentityType
    public function identityType()
    {
        return $this->belongsTo(IdentityType::class, 'identity_id');
    }
}
