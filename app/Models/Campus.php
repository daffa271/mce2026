<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    protected $fillable = [
        'name','slug','logo_path','description','type','website','contact'
    ];
}
