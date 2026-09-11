<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->enum('kategori', ['Bus Pariwisata', 'Toko Bangunan', 'Konstruksi'])
                ->default('Bus Pariwisata')
                ->after('judul');
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
