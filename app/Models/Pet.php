<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $table = 'kuliah_wf_2025_pet';
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
}
