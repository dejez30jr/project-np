<?php

namespace App\Support;

class PaymentStatuses
{
    /**
     * Daftar status pembayaran invoice tetap.
     *
     * @return array<string, string> key => label
     */
    public static function all(): array
    {
        return [
            'unpaid' => 'Unpaid',
            'pending' => 'Pending',
            'paid' => 'Paid',
            'cancelled' => 'Cancelled',
        ];
    }

    /**
     * Label dari sebuah key, atau key itu sendiri bila tidak dikenal.
     */
    public static function label(?string $key): string
    {
        return self::all()[$key] ?? ucfirst((string) $key);
    }

    /**
     * Warna badge untuk setiap status pembayaran (dipakai di Filament).
     */
    public static function color(string $key): string
    {
        return match ($key) {
            'paid' => 'success',
            'pending' => 'warning',
            'cancelled' => 'danger',
            default => 'info',
        };
    }
}
