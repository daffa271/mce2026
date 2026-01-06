<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketPackage extends Model
{
    protected $fillable = [
        'name',
        'price',
        'description',
        'benefits',
        'quota',
        'sold',
        'is_active',
        'valid_from',
        'valid_until',
        'is_bundle',
        'bundle_size',
    ];

    protected $casts = [
        'benefits' => 'array',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
        'is_bundle' => 'boolean',
        'valid_from' => 'date',
        'valid_until' => 'date',
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function isAvailable(): bool
    {
        return $this->is_active && $this->sold < $this->quota;
    }

    public function getRemainingQuotaAttribute(): int
    {
        return max(0, $this->quota - $this->sold);
    }
}
