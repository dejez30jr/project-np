@extends('layouts.app')

@section('content')
    <style>
        .reg-input {
            background-color: transparent;
            border: 1px solid rgba(255, 255, 255, 0.35);
            border-radius: 8px;
            padding: 16px;
            color: #fff;
            width: 100%;
            font-size: 1rem;
        }

        .reg-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .reg-label {
            display: block;
            color: #fff;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .reg-section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .reg-field-error {
            display: block;
            color: #fca5a5;
            font-size: 0.875rem;
            margin-top: 4px;
        }
    </style>

    <section class="py-10 md:py-16 min-h-[80vh]">
        <div class="max-w-3xl mx-auto">
            {{-- Header halaman --}}
            <div class="text-center mb-10" data-aos="fade-up">
                <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight">
                    Client Registration
                </h1>
                <p class="text-white/70 mt-4 text-base md:text-lg leading-relaxed">
                    Sudah siap memulai project bersama kami? Isi formulir di bawah ini dan
                    tim kami akan menghubungi Anda untuk proses selanjutnya.
                </p>
            </div>

            {{-- Pesan Error Validasi (umum) --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    <ul style="list-style: disc; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Alert Sukses --}}
            @if (session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            title: "Data berhasil dikirim!",
                            text: @json(session('success')),
                            icon: "success",
                            draggable: true
                        });
                    });
                </script>
            @endif

            {{-- Alert Rate Limit / Error --}}
            @if (session('error'))
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            title: "Terlalu banyak pendaftaran!",
                            text: @json(session('error')),
                            icon: "warning",
                            draggable: true
                        });
                    });
                </script>
            @endif

            {{-- FORM UTAMA --}}
            <form action="{{ route('client.register.store') }}" method="POST"
                class="flex flex-col gap-6 p-4 md:p-8 rounded-2xl bg-gradient-to-r from-[#363089] to-[#1C1762]">
                <div class="flex flex-col gap-8 border border-white p-4 md:p-8 rounded-xl">
                    @csrf

                    {{-- Honeypot: field tersembunyi anti-bot --}}
                    <div class="hidden" aria-hidden="true">
                        <input type="text" name="website" value="" tabindex="-1" autocomplete="off" />
                    </div>

                    {{-- ===== SECTION 1: Data Client ===== --}}
                    <div>
                        <h2 class="reg-section-title">Data Client</h2>
                        <p class="text-white/60 text-sm mb-6">
                            Nama dan NIK digunakan sebagai data identitas client dalam perjanjian kerja sama.
                        </p>

                        <div class="flex flex-col gap-5">
                            <div>
                                <label for="reg-name" class="reg-label">Nama Lengkap Sesuai KTP</label>
                                <input id="reg-name" class="reg-input" type="text" name="name" required
                                    maxlength="100" placeholder="Nama lengkap sesuai KTP" value="{{ old('name') }}" />
                                @error('name')
                                    <span class="reg-field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="reg-nik" class="reg-label">NIK</label>
                                <input id="reg-nik" class="reg-input" type="text" name="nik" required
                                    inputmode="numeric" autocomplete="off" maxlength="16" minlength="16"
                                    pattern="[0-9]{16}" placeholder="16 digit nomor NIK" value="{{ old('nik') }}" />
                                @error('nik')
                                    <span class="reg-field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="reg-whatsapp" class="reg-label">Nomor WhatsApp</label>
                                <input id="reg-whatsapp" class="reg-input" type="tel" name="whatsapp" required
                                    maxlength="20" placeholder="contoh: 081234567890" value="{{ old('whatsapp') }}" />
                                @error('whatsapp')
                                    <span class="reg-field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="reg-address" class="reg-label">Alamat Lengkap</label>
                                <textarea id="reg-address" class="reg-input" name="address" required maxlength="500" cols="15"
                                    rows="4" placeholder="Alamat lengkap sesuai domisili / KTP">{{ old('address') }}</textarea>
                                @error('address')
                                    <span class="reg-field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- ===== SECTION 2: Detail Project ===== --}}
                    <div class="border-t border-white/20 pt-8">
                        <h2 class="reg-section-title">Detail Project</h2>
                        <p class="text-white/60 text-sm mb-6">
                            Cukup jelaskan kebutuhan Anda secara singkat. Detail akan dibahas bersama tim kami.
                        </p>

                        <div class="flex flex-col gap-5">
                            <div>
                                <label for="reg-project-name" class="reg-label">Nama Project / Nama Website</label>
                                <input id="reg-project-name" class="reg-input" type="text" name="project_name"
                                    required maxlength="150" placeholder="contoh: Website Company Profile TokoKu"
                                    value="{{ old('project_name') }}" />
                                @error('project_name')
                                    <span class="reg-field-error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="reg-project-desc" class="reg-label">Deskripsi Singkat Project</label>
                                <textarea id="reg-project-desc" class="reg-input" name="project_description" required maxlength="2000"
                                    cols="15" rows="6"
                                    placeholder="Jelaskan deskripsi singkat project serta kebutuhan / layanan yang ingin Anda buat.">{{ old('project_description') }}</textarea>
                                @error('project_description')
                                    <span class="reg-field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- ===== SECTION 3: Persetujuan ===== --}}
                    <div class="border-t border-white/20 pt-8">
                        <h2 class="reg-section-title">Persetujuan</h2>
                        <p class="text-white/70 text-sm leading-relaxed mb-4">
                            Data yang Anda isi digunakan sebagai data client dan dasar administrasi kerja sama project.
                        </p>

                        <ul class="text-white/70 text-sm leading-relaxed mb-6 space-y-2 list-disc pl-5">
                            <li>Client wajib memberikan data dan informasi yang dibutuhkan untuk pengerjaan project.</li>
                            <li>Client wajib memberikan feedback atau respons yang dibutuhkan selama proses pengerjaan.</li>
                            <li>Jika client terlambat memberikan data, feedback, atau respons yang menjadi tanggung jawab
                                client, waktu pengerjaan dapat ikut menyesuaikan.</li>
                            <li>Jika terdapat kondisi yang sesuai dengan ketentuan perjanjian kerja sama, client dapat
                                dikenakan denda sebesar Rp25.000.</li>
                            <li>Apabila project telah dikerjakan sesuai kesepakatan tetapi client tidak memberikan respons
                                atau meninggalkan project, penyelesaian akan mengikuti perjanjian kerja sama dan ketentuan
                                hukum yang berlaku.</li>
                        </ul>

                        <label class="inline-flex items-start gap-3 cursor-pointer select-none">
                            <input id="reg-agreement" type="checkbox" name="agreement_accepted" value="1" required
                                class="mt-1 w-5 h-5 accent-purple-700" />
                            <span class="text-white text-sm leading-relaxed">
                                Saya telah membaca, memahami, dan menyetujui persyaratan serta konsekuensi yang berlaku
                                dalam perjanjian kerja sama.
                            </span>
                        </label>
                        @error('agreement_accepted')
                            <span class="reg-field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- ==== SECTION 4: Submit ===== --}}
                    <div class="border-t border-white/20 pt-8">
                        <button type="submit" id="btn-register"
                            class="w-full rounded-tr-3xl rounded-bl-3xl p-4 px-10 bg-gradient-to-r from-[#4f46e5] to-[#1C1762] border border-white/20 hover:brightness-110 transition cursor-pointer text-white font-bold">
                            Kirim Data Client
                        </button>
                        <p class="text-white/50 text-xs text-center mt-4">
                            Dengan menekan tombol di atas, data Anda telah terkunci dan tidak dapat diubah melalui halaman
                            ini.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        const formRegister = document.querySelector('form[action="{{ route('client.register.store') }}"]');
        let isSending = false;

        if (formRegister) {
            // Sanitasi client-side: buang tag HTML agar tidak bisa injeksi <script> dsb.
            formRegister.querySelectorAll('input[name], textarea[name]').forEach((el) => {
                el.addEventListener('input', () => {
                    el.value = el.value.replace(/<[^>]*>/g, '');
                });
            });

            const nikInput = document.getElementById('reg-nik');
            if (nikInput) {
                nikInput.addEventListener('input', () => {
                    nikInput.value = nikInput.value.replace(/[^0-9]/g, '').slice(0, 16);
                });
            }

            // Cegah double submit
            formRegister.addEventListener('submit', function (e) {
                if (isSending) {
                    e.preventDefault();
                    return;
                }
                isSending = true;

                const btn = document.getElementById('btn-register');
                if (btn) {
                    btn.disabled = true;
                    btn.textContent = 'Mengirim...';
                }
            });
        }
    </script>
@endsection