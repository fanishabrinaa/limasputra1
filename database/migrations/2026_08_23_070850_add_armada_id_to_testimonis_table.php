<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('testimonis', function (Blueprint $table) {
        $table->foreignId('armada_id')->nullable()->after('id')->constrained()->nullOnDelete();
    });
}

public function down(): void
{
    Schema::table('testimonis', function (Blueprint $table) {
        $table->dropForeign(['armada_id']);
        $table->dropColumn('armada_id');
    });
}
};
