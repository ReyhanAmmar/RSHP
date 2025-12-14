<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class RekamMedis extends Model
{
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->deleted_by = Auth::user()->iduser;
                $model->save();
            }
        });
    }

    protected $table = 'rekam_medis';
    protected $primaryKey = 'idrekam_medis';
    public $timestamps = true;

    protected $fillable = [
        'idreservasi_dokter', // Pastikan kolom ini ada di fillable
        'idpet',
        'dokter_pemeriksa',
        'anamnesa',
        'temuan_klinis',
        'diagnosa',
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }

    public function temuDokter()
    {
        return $this->belongsTo(TemuDokter::class, 'idreservasi_dokter', 'idreservasi_dokter');
    }
}