<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataLomba extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function peserta(){
        return $this->hasMany(Peserta::class);
    }
    public function juri(){
        return $this->hasMany(Juri::class);
    }
    public function penilaian_karikatur(){
        return $this->hasMany(PenilaianKarikatur::class);
    }

    public function penilaian_pioneering(){
        return $this->hasMany(PenilaianPioneering::class);
    }

    public function lomba_foto_vidio(){
        return $this->hasMany(LombaFotoVidio::class);
    }

    public function bobot_soal(){
        return $this->hasMany(BobotSoal::class);
    }

    public function cbtSessions(){
        return $this->hasMany(CbtSession::class);
    }

}
