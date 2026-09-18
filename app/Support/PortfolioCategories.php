<?php

namespace App\Support;

class PortfolioCategories
{
    /**
     * Daftar kategori portfolio tetap.
     * Dipakai oleh dropdown Filament & tab filter halaman web.
     *
     * @return array<string, string> key => label
     */
    public static function all(): array
    {
        return [
            'website' => 'Website',
            'poster' => 'Poster/Flyer',
            'banner' => 'Banner',
            'mockup' => 'Mockup',
            'logo' => 'Logo',
            'social' => 'Social Media',
        ];
    }

    /**
     * Label dari sebuah key, atau key itu sendiri bila tidak dikenal.
     */
    public static function label(?string $key): string
    {
        return self::all()[$key] ?? ucfirst((string) $key);
    }
}
