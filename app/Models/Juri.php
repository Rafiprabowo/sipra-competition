<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juri extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function mata_lomba(){
        return $this->belongsTo(MataLomba::class);
    }
    public function penilaian_karikatur(){
        return $this->hasMany(PenilaianKarikatur::class);
    }

    public function penilaian_pionering(){
        return $this->hasMany(PenilaianPionering::class);
    }

    public function penilaian_duta_logika(){
        return $this->hasMany(PenilaianDutaLogika::class);
    }

    public function penilaian_lkfbb(){
        return $this->hasMany(PenilaianLkfbb::class);
    }

    public function penilaian_foto(){
        return $this->hasMany(PenilaianFoto::class);
    }

    public function penilaian_vidio(){
        return $this->hasMany(PenilaianVidio::class);
    }
}
