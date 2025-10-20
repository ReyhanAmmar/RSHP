<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Roleuser extends Model
{
    protected $table = 'role_user';

    protected $primaryKey = 'idroleuser';

    protected $fillable = [
        'iduser',
        'idrole',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }

    public function role()
    {
        return $this->belongsTo(role::class, 'idrole', 'idrole');
    }
}
