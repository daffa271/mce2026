<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    // Karena migration membuat tabel 'feedback'
    protected $table = 'feedback';

    protected $fillable = [
        'message',
        'category',
        'addressed',
    ];

    protected $casts = [
        'addressed' => 'boolean',
    ];
}
