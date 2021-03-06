<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $fillable = [
        'nama_matpel',
        'kkm'
    ];

    public function ujian()
    {
        return $this->hasMany('App\Ujian');
    }
}
