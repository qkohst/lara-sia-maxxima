<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'id_ujian',
        'id_siswa',
        'nilai'
    ];

    public function ujian()
    {
        return $this->belongsTo('App\Ujian', 'id_ujian');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Siswa', 'id_siswa');
    }
}
