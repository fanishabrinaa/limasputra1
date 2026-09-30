<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('produk', function (Blueprint $table) {
        $table->string('kategori')->nullable()->after('nama_produk');
        $table->string('badge')->nullable()->after('kategori');
        $table->string('satuan')->nullable()->after('deskripsi');
        $table->unsignedInteger('stok')->default(0)->after('satuan');
        $table->string('sku')->nullable()->after('stok');
        $table->json('spesifikasi')->nullable()->after('sku');
        $table->json('keunggulan')->nullable()->after('spesifikasi');
        $table->json('galeri')->nullable()->after('gambar');
    });
}

    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn(['kategori','badge','satuan','stok','sku','spesifikasi','keunggulan','galeri']);
        });
    }
};