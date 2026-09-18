<?php

namespace App\Support;

use Illuminate\Support\Facades\Session;

class MathCaptcha
{
    private const SESSION_KEY = 'math_captcha';

    private const EXPIRY_SECONDS = 300;

    private const MAX_ENTRIES = 5;

    /**
     * Buat pertanyaan matematika acak dan simpan jawabannya di session.
     *
     * @return array{token: string, question: string}
     */
    public static function generate(): array
    {
        $operators = ['+', '-'];
        $operator = $operators[array_rand($operators)];

        $a = random_int(1, 9);
        $b = random_int(1, 9);

        // Hindari hasil negatif pada pengurangan
        if ($operator === '-' && $a < $b) {
            [$a, $b] = [$b, $a];
        }

        $answer = match ($operator) {
            '+' => $a + $b,
            '-' => $a - $b,
        };

        $token = bin2hex(random_bytes(16));

        $entries = Session::get(self::SESSION_KEY, []);
        $entries[$token] = [
            'answer' => $answer,
            'time' => now()->timestamp,
        ];

        // Batasi jumlah entry agar session tidak membengkak
        if (count($entries) > self::MAX_ENTRIES) {
            $entries = array_slice($entries, -self::MAX_ENTRIES, null, true);
        }

        Session::put(self::SESSION_KEY, $entries);

        return [
            'token' => $token,
            'question' => "{$a} {$operator} {$b} = ?",
        ];
    }

    /**
     * Verifikasi jawaban. Token bersifat one-time use (langsung dihapus).
     */
    public static function validate(?string $token, ?string $input): bool
    {
        if (! $token || $input === null || ! is_numeric($input)) {
            return false;
        }

        $entries = Session::get(self::SESSION_KEY, []);
        $entry = $entries[$token] ?? null;

        unset($entries[$token]);
        Session::put(self::SESSION_KEY, $entries);

        if (! $entry) {
            return false;
        }

        if (now()->timestamp - $entry['time'] > self::EXPIRY_SECONDS) {
            return false;
        }

        return (int) $input === (int) $entry['answer'];
    }
}
