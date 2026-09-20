<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nik',
        'whatsapp',
        'address',
        'project_name',
        'project_description',
        'status',
    ];

    protected $casts = [
        'agreement_accepted' => 'boolean',
        'agreement_accepted_at' => 'datetime',
    ];

    /**
     * A client can have many invoices.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Sembunyikan NIK sebagian untuk privasi di halaman publik (jika dipakai).
     */
    public function getNikMaskedAttribute(): string
    {
        return substr($this->nik, 0, 6).str_repeat('*', 6).substr($this->nik, -4);
    }
}
