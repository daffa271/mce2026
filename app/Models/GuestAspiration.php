<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuestAspiration extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'school',
        'message',
        'category',
        'type',
        'rating',
        'allow_contact',
        'status',
    ];
}
