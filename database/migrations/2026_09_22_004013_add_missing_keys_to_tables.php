<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     *
     * Migration ini menambal tabel `users`, `pemesanans`, `pesan_masuks`,
     * `produk`, dan `testimonis` yang sebelumnya tidak punya PRIMARY KEY
     * (akibat dump SQL yang terpotong saat import). Semua pengecekan
     * dibuat aman (idempotent) supaya migration ini bisa dijalankan baik
     * di database yang sudah dibetulkan manual lewat phpMyAdmin, maupun
     * di database baru yang di-migrate dari nol.
     */
    public function up(): void
    {
        // ===== 1. Tambahkan PRIMARY KEY + AUTO_INCREMENT jika belum ada =====

        if (!$this->hasPrimaryKey('users')) {
            DB::statement('ALTER TABLE `users` ADD PRIMARY KEY (`id`)');
            DB::statement('ALTER TABLE `users` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        }
        if (!$this->hasUniqueKey('users', 'users_email_unique')) {
            DB::statement('ALTER TABLE `users` ADD UNIQUE KEY `users_email_unique` (`email`)');
        }

        if (!$this->hasPrimaryKey('pemesanans')) {
            DB::statement('ALTER TABLE `pemesanans` ADD PRIMARY KEY (`id`)');
            DB::statement('ALTER TABLE `pemesanans` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        }

        if (!$this->hasPrimaryKey('pesan_masuks')) {
            DB::statement('ALTER TABLE `pesan_masuks` ADD PRIMARY KEY (`id`)');
            DB::statement('ALTER TABLE `pesan_masuks` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        }

        if (!$this->hasPrimaryKey('produk')) {
            DB::statement('ALTER TABLE `produk` ADD PRIMARY KEY (`id`)');
            DB::statement('ALTER TABLE `produk` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        }

        if (!$this->hasPrimaryKey('testimonis')) {
            DB::statement('ALTER TABLE `testimonis` ADD PRIMARY KEY (`id`)');
            DB::statement('ALTER TABLE `testimonis` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT');
        }

        // ===== 2. Tambahkan index biasa untuk kolom foreign key =====

        $this->addIndexIfMissing('pemesanans', 'pemesanans_user_id_foreign', 'user_id');
        $this->addIndexIfMissing('pemesanans', 'pemesanans_armada_id_foreign', 'armada_id');

        $this->addIndexIfMissing('testimonis', 'testimonis_armada_id_foreign', 'armada_id');
        $this->addIndexIfMissing('testimonis', 'testimonis_user_id_foreign', 'user_id');
        $this->addIndexIfMissing('testimonis', 'testimonis_pemesanan_id_foreign', 'pemesanan_id');

        // ===== 3. Tambahkan FOREIGN KEY CONSTRAINT jika belum ada =====

        $this->addForeignKeyIfMissing(
            'armada_fasilitas',
            'armada_fasilitas_armada_id_foreign',
            'ALTER TABLE `armada_fasilitas` ADD CONSTRAINT `armada_fasilitas_armada_id_foreign` FOREIGN KEY (`armada_id`) REFERENCES `armadas` (`id`) ON DELETE CASCADE'
        );
        $this->addForeignKeyIfMissing(
            'armada_fasilitas',
            'armada_fasilitas_fasilitas_id_foreign',
            'ALTER TABLE `armada_fasilitas` ADD CONSTRAINT `armada_fasilitas_fasilitas_id_foreign` FOREIGN KEY (`fasilitas_id`) REFERENCES `fasilitas` (`id`) ON DELETE CASCADE'
        );

        $this->addForeignKeyIfMissing(
            'passkeys',
            'passkeys_user_id_foreign',
            'ALTER TABLE `passkeys` ADD CONSTRAINT `passkeys_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE'
        );

        $this->addForeignKeyIfMissing(
            'pemesanans',
            'pemesanans_user_id_foreign',
            'ALTER TABLE `pemesanans` ADD CONSTRAINT `pemesanans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL'
        );
        $this->addForeignKeyIfMissing(
            'pemesanans',
            'pemesanans_armada_id_foreign',
            'ALTER TABLE `pemesanans` ADD CONSTRAINT `pemesanans_armada_id_foreign` FOREIGN KEY (`armada_id`) REFERENCES `armadas` (`id`) ON DELETE CASCADE'
        );

        $this->addForeignKeyIfMissing(
            'testimonis',
            'testimonis_armada_id_foreign',
            'ALTER TABLE `testimonis` ADD CONSTRAINT `testimonis_armada_id_foreign` FOREIGN KEY (`armada_id`) REFERENCES `armadas` (`id`) ON DELETE SET NULL'
        );
        $this->addForeignKeyIfMissing(
            'testimonis',
            'testimonis_user_id_foreign',
            'ALTER TABLE `testimonis` ADD CONSTRAINT `testimonis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL'
        );
        $this->addForeignKeyIfMissing(
            'testimonis',
            'testimonis_pemesanan_id_foreign',
            'ALTER TABLE `testimonis` ADD CONSTRAINT `testimonis_pemesanan_id_foreign` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanans` (`id`) ON DELETE SET NULL'
        );
    }

    /**
     * Batalkan migration (hapus FK dulu baru bisa hapus PK).
     */
    public function down(): void
    {
        $this->dropForeignKeyIfExists('testimonis', 'testimonis_pemesanan_id_foreign');
        $this->dropForeignKeyIfExists('testimonis', 'testimonis_user_id_foreign');
        $this->dropForeignKeyIfExists('testimonis', 'testimonis_armada_id_foreign');

        $this->dropForeignKeyIfExists('pemesanans', 'pemesanans_armada_id_foreign');
        $this->dropForeignKeyIfExists('pemesanans', 'pemesanans_user_id_foreign');

        $this->dropForeignKeyIfExists('passkeys', 'passkeys_user_id_foreign');

        $this->dropForeignKeyIfExists('armada_fasilitas', 'armada_fasilitas_fasilitas_id_foreign');
        $this->dropForeignKeyIfExists('armada_fasilitas', 'armada_fasilitas_armada_id_foreign');

        // Primary key & unique key sengaja TIDAK di-drop di sini,
        // karena berbahaya (bisa mematahkan auto_increment / data yang
        // sudah bergantung padanya). Kalau memang perlu rollback total,
        // lakukan manual lewat phpMyAdmin.
    }

    private function hasPrimaryKey(string $table): bool
    {
        $result = DB::select("SHOW KEYS FROM `{$table}` WHERE Key_name = 'PRIMARY'");
        return count($result) > 0;
    }

    private function hasUniqueKey(string $table, string $keyName): bool
    {
        $result = DB::select("SHOW KEYS FROM `{$table}` WHERE Key_name = ?", [$keyName]);
        return count($result) > 0;
    }

    private function addIndexIfMissing(string $table, string $indexName, string $column): void
    {
        $exists = DB::select("SHOW KEYS FROM `{$table}` WHERE Key_name = ?", [$indexName]);
        if (count($exists) === 0) {
            DB::statement("ALTER TABLE `{$table}` ADD KEY `{$indexName}` (`{$column}`)");
        }
    }

    private function addForeignKeyIfMissing(string $table, string $constraintName, string $sql): void
    {
        $exists = DB::select(
            'SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
             WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND CONSTRAINT_TYPE = "FOREIGN KEY"',
            [$table, $constraintName]
        );

        if (count($exists) === 0) {
            DB::statement($sql);
        }
    }

    private function dropForeignKeyIfExists(string $table, string $constraintName): void
    {
        $exists = DB::select(
            'SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS
             WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = ? AND CONSTRAINT_NAME = ? AND CONSTRAINT_TYPE = "FOREIGN KEY"',
            [$table, $constraintName]
        );

        if (count($exists) > 0) {
            DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$constraintName}`");
        }
    }
};