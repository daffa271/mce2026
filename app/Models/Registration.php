<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_package_id',
        'discount_code_id',
        'registration_code',
        'name',
        'school',
        'grade',
        'email',
        'phone',
        'interested_majors',
        'interested_campuses',
        'payment_status',
        'verification_status',
        'payment_method',
        'payment_proof',
        'payment_notes',
        'total_amount',
        'discount_percentage',
        'original_amount',
        'quantity',
        'bundle_participants',
        'bundle_barcodes',
        'paid_at',
        'verified_at',
        'qr_code_path',
        'is_checked_in',
        'checked_in_at',
        'barcode',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'original_amount' => 'decimal:2',
        'bundle_participants' => 'array',
        'bundle_barcodes' => 'array',
        'is_checked_in' => 'boolean',
        'paid_at' => 'datetime',
        'verified_at' => 'datetime',
        'checked_in_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketPackage()
    {
        return $this->belongsTo(\App\Models\TicketPackage::class);
    }

    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class);
    }

    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    public function isPending(): bool
    {
        return $this->payment_status === 'pending';
    }

    public function isVerified(): bool
    {
        return $this->verification_status === 'verified';
    }

    public function isAwaitingVerification(): bool
    {
        return $this->payment_status === 'paid' && $this->verification_status === 'pending';
    }

    public function getStatusBadgeAttribute(): string
    {
        if ($this->verification_status === 'verified') {
            return 'Terverifikasi';
        }
        if ($this->payment_status === 'pending') {
            return 'Belum Membayar';
        }
        if ($this->isAwaitingVerification()) {
            return 'Menunggu Verifikasi';
        }
        return 'Ditolak';
    }
}
