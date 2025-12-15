<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Daftar tabel yang akan ditambahkan soft deletes.
     */
    protected $tables = [
        'user',
        'pet',
        'dokter',
        'pemilik',
        'perawat',
        'rekam_medis',
        'temu_dokter',
        'detail_rekam_medis',
        'jenis_hewan',
        'ras_hewan',
        'kategori',
        'kategori_klinis',
        'kode_tindakan_terapi',
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            // Cek dulu apakah tabelnya ada
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    
                    // Cek apakah kolom deleted_at BELUM ada, baru buat
                    if (!Schema::hasColumn($tableName, 'deleted_at')) {
                        $table->softDeletes();
                    }

                    // Cek apakah kolom deleted_by BELUM ada, baru buat
                    if (!Schema::hasColumn($tableName, 'deleted_by')) {
                        // Pastikan menaruhnya setelah deleted_at agar rapi
                        // Jika deleted_at baru saja dibuat, ia akan ada di akhir, 
                        // tapi jika sudah ada sebelumnya, 'after' tetap valid.
                        $table->unsignedBigInteger('deleted_by')->nullable()->after('deleted_at');
                    }
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                    // Cek jika ada baru dihapus, untuk menghindari error saat rollback
                    if (Schema::hasColumn($tableName, 'deleted_by')) {
                        $table->dropColumn('deleted_by');
                    }
                    if (Schema::hasColumn($tableName, 'deleted_at')) {
                        $table->dropSoftDeletes();
                    }
                });
            }
        }
    }
};