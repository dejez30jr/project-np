# Deploy Laravel ke Hostinger (cPanel) — Panduan

## Prasyarat
- SSH/Terminal di hosting (Hostinger: hPanel -> Advanced -> SSH Access, aktifkan dulu)
- Composer dirilis di server (Hostinger sudah include `composer`)
- MySQL di hPanel -> Databases (buat `user` + `database`, kasih ALL PRIVILEGES)

## Upload via Git (Hostinger Git auto-deploy)
1. hPanel -> Websites -> pilih domain -> Manage -> ubah **Document Root** menjadi:
   ```
   public_html/public
   ```
2. hPanel -> Git -> Hubungkan repo `github.com/dejez30jr/project-np` (atau Hostinger Dashboard -> Websites -> Git).
   Deploy path (branch `main`) otomatis masuk ke `public_html`.
3. Setiap `git push` dari lokal = otomatis update di server.

> Atau upload manual: ZIP project -> File Manager -> Extract. Hapus `vendor/`, `node_modules/`, `.env` sebelum zip biar kecil.

## Setup pertama kali (Terminal)
```bash
cd ~/public_html

# 1. .env dari template (isi DB_* & APP_URL dengan data hPanel)
cp deploy/.env.production.example .env
nano .env

# 2. Kunci aplikasi + dependencies
php artisan key:generate
composer install --no-dev --optimize-autoloader

# 3. Symlink storage (gambar portfolio) + migrasi
php artisan storage:link
php artisan migrate --force

# 4. Cache produksi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Permission (folder storage harus bisa ditulis PHP)
chmod -R 775 storage bootstrap/cache
```

## Fallback kalau Terminal tidak ada
Jalankan `deploy/make-storage-link.php` lewat browser sekali (bikin symlink `public/storage`),
lalu hapus setelah selesai.

## Verifikasi
- Buka `https://domainanda.com` -> harus tampil Home.
- Form kontak -> tes kirim (cek muncul popup SweetAlert).
- Dashboard admin `https://domainanda.com/admin`.

## Catatan
- `.env` JANGAN pernah di-commit (sudah di .gitignore). Selalu buat manual di server.
- Setelah ubah `.env` pada produksi, jalankan `php artisan config:clear` lalu `config:cache`.
- Gambar portfolio baru otomatis muncul karena DB shared (storage:link + APP_URL sudah benar).
- Gmail SMTP: pakai App Password 16 karakter (bukan password akun), aktifkan 2FA dulu.
