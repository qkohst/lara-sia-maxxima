<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable = [
        'nis',
        'nama',
        'alamat'
    ];

    public function peserta()
    {
        return $this->hasMany('App\Peserta');
    }
}
