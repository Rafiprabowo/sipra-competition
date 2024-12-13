<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotSoal extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function penilaian_karikatur(){
        return $this->hasMany(PenilaianKarikatur::class);
    }

    public function penilaian_pioneering(){
        return $this->hasMany(PenilaianPioneering::class);
    }

    public function penilaian_duta_logika(){
        return $this->hasMany(PenilaianDutaLogika::class);
    }

    public function penilaian_lkfbb(){
        return $this->hasMany(PenilaianLkfbb::class);
    }

    public function mata_lomba(){
        return $this->belongsTo(MataLomba::class);
    }
}
