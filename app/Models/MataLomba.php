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

    public function upload_lomba(){
        return $this->hasOne(UploadLomba::class);
    }

}
