<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $fillable = [
        'user_id',
        'message',
        'category',
        'type',
        'rating',
        'allow_contact',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
