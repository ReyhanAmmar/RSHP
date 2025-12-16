<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Pet extends Model
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

    protected $table = 'pet';
    protected $primaryKey = 'idpet';
    public $timestamps = false;
    protected $fillable = [
        'idpet', 'nama', 'tanggal_lahir', 'warna_tanda',
        'jenis_kelamin', 'idpemilik', 'idras_hewan'
    ];

    public function pemilik()
    {
        return $this->belongsTo(Pemilik::class, 'idpemilik', 'idpemilik');
    }

    public function rasHewan()
    {
        return $this->belongsTo(RasHewan::class, 'idras_hewan', 'idras_hewan');
    }
    
    public function jenisHewan()
    {
        return $this->hasOneThrough(JenisHewan::class, RasHewan::class, 'idras_hewan', 'idjenis_hewan', 'idras_hewan', 'idjenis_hewan');
    }

    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class, 'idpet', 'idpet');
    }
}
