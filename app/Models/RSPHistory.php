<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RSPHistory extends Model
{
    protected $table = 'rsp_history';

    protected $fillable = [
        'user_id',
        'rsp_value',
        'description',
    ];

    /**
     * Relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
