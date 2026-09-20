<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Cegah NIK yang sama terdaftar lebih dari sekali (data identitas unik).
     */
    public function up(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unique('nik');
        });
    }

    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropUnique(['nik']);
        });
    }
};