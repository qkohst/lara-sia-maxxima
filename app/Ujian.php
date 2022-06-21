<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $fillable = [
        'nama_ujian',
        'id_matpel',
        'tanggal'
    ];

    public function mata_pelajaran()
    {
        return $this->belongsTo('App\MataPelajaran', 'id_matpel');
    }

    public function peserta()
    {
        return $this->hasMany('App\Peserta');
    }
}
