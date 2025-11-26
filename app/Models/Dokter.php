<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $timestamps = false;

    protected $fillable = [
        'iduser', 'alamat', 'no_hp', 'bidang_dokter', 'jenis_kelamin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}