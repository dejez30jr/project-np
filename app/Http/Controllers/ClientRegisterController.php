<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientRegisterController extends Controller
{
    /**
     * Tampilkan form registrasi client.
     */
    public function create()
    {
        return view('page.client-register');
    }

    /**
     * Simpan data client yang dikirim dari form Blade.
     */
    public function store(Request $request)
    {
        // 1. Cek honeypot (bot akan mengisi field tersembunyi ini)
        if ($request->filled('website')) {
            abort(403, 'Suspected bot activity.');
        }

        // 2. Validasi data
        $request->validate([
            'name' => 'required|string|max:100|regex:/^[\pL\s\.\'-]+$/u',
            'nik' => 'required|digits:16',
            'whatsapp' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'project_name' => 'required|string|max:150',
            'project_description' => 'required|string|max:2000',
            'agreement_accepted' => 'required|accepted',
        ], [
            'nik.digits' => 'NIK harus terdiri dari 16 digit angka.',
            'agreement_accepted.required' => 'Anda harus menyetujui persyaratan kerja sama terlebih dahulu.',
            'agreement_accepted.accepted' => 'Anda harus menyetujui persyaratan kerja sama terlebih dahulu.',
        ]);

        // 3. Sanitasi XSS / HTML injection
        $validated = $request->only([
            'name',
            'nik',
            'whatsapp',
            'address',
            'project_name',
            'project_description',
        ]);

        $validated['name'] = strip_tags(trim($validated['name']));
        $validated['nik'] = trim($validated['nik']);
        $validated['whatsapp'] = trim($validated['whatsapp']);
        $validated['address'] = strip_tags(trim($validated['address']));
        $validated['project_name'] = strip_tags(trim($validated['project_name']));
        $validated['project_description'] = strip_tags(trim($validated['project_description']));

        if (blank($validated['address']) || blank($validated['project_description'])) {
            return back()->withErrors(['address' => 'Alamat dan deskripsi project tidak boleh kosong.'])->withInput();
        }

        // 4. Simpan ke Database
        Client::create(array_merge($validated, [
            'status' => 'new',
            'agreement_accepted' => true,
            'agreement_accepted_at' => now(),
        ]));

        return redirect()
            ->route('client.register')
            ->with('success', 'Data berhasil dikirim. Tim kami akan menghubungi Anda untuk proses selanjutnya.');
    }
}
