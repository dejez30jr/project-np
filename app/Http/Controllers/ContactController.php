<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Support\MathCaptcha;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1. Cek honeypot (bot akan mengisi field tersembunyi ini)
        if ($request->filled('website')) {
            abort(403, 'Suspected bot activity.');
        }

        // 2. Validasi data (batasi panjang untuk cegah overload / spam)
        $request->validate([
            'name' => 'required|string|max:100|regex:/^[\pL\s\.\'-]+$/u',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:2000',
            'captcha' => 'required|string',
            'captcha_token' => 'required|string',
        ]);

        // 3. Verifikasi CAPTCHA (one-time use)
        if (! MathCaptcha::validate($request->input('captcha_token'), $request->input('captcha'))) {
            return back()
                ->withErrors(['captcha' => 'Jawaban verifikasi salah atau sudah kedaluwarsa. Silakan coba lagi.'])
                ->withInput();
        }

        // 4. Sanitasi XSS / HTML injection
        $validated = $request->only(['name', 'email', 'message']);
        $validated['name'] = strip_tags(trim($validated['name']));
        $validated['email'] = trim($validated['email']);
        $validated['message'] = strip_tags(trim($validated['message']));

        if ($validated['name'] === '' || $validated['message'] === '') {
            return back()->withErrors(['message' => 'Nama dan pesan tidak boleh kosong.'])->withInput();
        }

        // 5. Simpan ke Database
        //    - Hanya kolom yang tervalidasi (safe) => aman dari mass assignment / parameter injection
        //    - Eloquent / query builder pakai parameter binding => aman dari SQL injection
        Pesan::create($validated);

        return back()->with('success', 'Terima kasih! Pesan Anda telah terkirim.');
    }
}
