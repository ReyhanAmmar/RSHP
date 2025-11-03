<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KodeTindakanTerapi extends Model
{
     protected $table = 'kode_tindakan_terapi';
    protected $primaryKey = 'idkode_tindakan_terapi';
    public $timestamps = false;
    protected $fillable = [
        'idkode_tindakan_terapi', 'kode',
        'deskripsi_tindakan_terapi', 'idkategori', 'idkategori_klinis'
    ];

    public function rekamMedis()
    {
        return $this->belongsToMany(
            RekamMedis::class,
            'detail_rekam_medis',
            'idkode_tindakan_terapi',
            'idrekam_medis'
        )->withPivot('iddetail_rekam_medis', 'detail');
    }
}