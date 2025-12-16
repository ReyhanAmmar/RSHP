<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class RekamMedis extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rekam_medis';

    protected $primaryKey = 'idrekam_medis';

    public $timestamps = true;

    protected $guarded = [];

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

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'iddokter', 'iddokter');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'idpet', 'idpet');
    }

    public function detailRekamMedis()
    {
        return $this->hasMany(DetailRekamMedis::class, 'idrekam_medis', 'idrekam_medis');
    }
}