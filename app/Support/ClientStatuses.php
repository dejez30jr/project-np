<?php

namespace App\Support;

class ClientStatuses
{
    /**
     * Daftar status client tetap.
     *
     * @return array<string, string> key => label
     */
    public static function all(): array
    {
        return [
            'new' => 'New',
            'active' => 'Active',
            'completed' => 'Completed',
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
     * Warna badge untuk setiap status (dipakai di Filament).
     */
    public static function color(string $key): string
    {
        return match ($key) {
            'active' => 'success',
            'completed' => 'primary',
            'cancelled' => 'danger',
            default => 'info',
        };
    }
}
