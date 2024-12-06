<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mata_lomba(){
        return $this->belongsTo(MataLomba::class);
    }
    public function penilaian_karikatur(){
        return $this->hasOne(PenilaianKarikatur::class);
    }

    public function penilaian_pioneering(){
        return $this->hasOne(PenilaianPioneering::class);
    }

    public function regu_pembina(){
        return $this->belongsTo(ReguPembina::class);
    }
}
