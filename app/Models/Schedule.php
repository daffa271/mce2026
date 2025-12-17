<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'title','description','date','start_time','end_time','location','order'
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
