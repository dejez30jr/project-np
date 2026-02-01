<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // 2. Simpan ke Database
        Pesan::create($request->all());

        return back()->with('success', 'Terima kasih! Pesan Anda telah terkirim.');
    }
}
