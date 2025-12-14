<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Dokter extends Model
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