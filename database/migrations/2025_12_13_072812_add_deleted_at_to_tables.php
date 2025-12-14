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
            if (Schema::hasTable($tableName)) {
                Schema::table($tableName, function (Blueprint $table) {
                    $table->softDeletes();
                    
                    $table->unsignedBigInteger('deleted_by')->nullable()->after('deleted_at');
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
                Schema::table($tableName, function (Blueprint $table) {
                    $table->dropColumn('deleted_by');
                    $table->dropSoftDeletes();
                });
            }
        }
    }
};