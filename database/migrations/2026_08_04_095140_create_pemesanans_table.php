<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pemesanans', function (Blueprint $table) {
        $table->id();
        $table->string('kode_pemesanan')->unique();

        $table->foreignId('armada_id')
              ->constrained('armadas')
              ->cascadeOnDelete();

        $table->string('nama_pemesan');
        $table->string('email');
        $table->string('no_hp');
        $table->string('instansi')->nullable();
        $table->date('tanggal_berangkat');
        $table->date('tanggal_pulang');
        $table->string('tujuan');
        $table->integer('jumlah_penumpang');
        $table->text('catatan')->nullable();
        $table->enum('status', [
            'Menunggu',
            'Diproses',
            'Disetujui',
            'Ditolak',
            'Selesai'
        ])->default('Menunggu');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::dropIfExists('pemesanans');
}
};
