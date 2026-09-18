<?php
/*
 * Helper sekali-pakai untuk membuat symlink public/storage -> storage/app/public
 * di hosting yang TIDAK punya akses Terminal (cPanel File Manager).
 *
 * CARA PAKAI:
 *  1. Upload file ini ke folder PROJECT/public/
 *  2. Buka di browser: https://domain.com/link.php
 *  3. Jika tampil "OK", HAPUS file ini dari server.
 */
$base = dirname(__DIR__);              // = folder root project
$target = $base . '/storage/app/public';
$link   = $base . '/public/storage';

// 1) Pastikan direktori target ada
if (!is_dir($target)) {
    @mkdir($target, 0775, true);
}
if (!is_dir($target)) {
    http_response_code(500);
    exit('ERROR: folder storage/app/public tidak bisa dibuat. Cek permission folder storage (755/775).');
}

// 2) Hapus symlink/folder lama kalau ada
if (file_exists($link)) {
    if (is_link($link)) {
        unlink($link);
    } else {
        exit('ERROR: public/storage sudah ada sebagai folder, bukan symlink. Hapus dulu via File Manager.');
    }
}

// 3) Buat symlink (fallback ke junction/dir kalau symlink diblokir)
if (@symlink($target, $link)) {
    echo 'OK';
} elseif (@mkdir($link) && copy($target . '/.gitignore', $link . '/.gitignore')) {
    echo 'OK (fallback copy)';
} else {
    http_response_code(500);
    echo 'ERROR: tidak bisa buat symlink dan folder fallback.';
}
