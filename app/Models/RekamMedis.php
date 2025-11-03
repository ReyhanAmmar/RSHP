<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    protected $table = 'rekam_medis';

    protected $primaryKey = 'idrekam_medis';

    public $timestamps = true;
    protected $fillable = [
        'idrekam_medis',
        'created_at',
        'anamnesa',
        'temuan_klinik',
        'diagnosa',
        'idpet',
        'dokter_pemeriksa',
    ];

    public function tindakan()
    {
        return $this->belongsToMany( KodeTindakanTerapi::class,
            'kuliah_wf_2025_detail_rekam_medis',
            'idrekam_medis',
            'idkode_tindakan_terapi'
        )->withPivot('iddetail_rekam_medis', 'detail');
    }
}
