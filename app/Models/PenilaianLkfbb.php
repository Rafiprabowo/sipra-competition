<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianLkfbb extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
    public function juri(){
        return $this->belongsTo(Juri::class);
    }
    public function mata_lomba(){
        return $this->belongsTo(MataLomba::class);
    }
    public function bobot_soal(){
        return $this->belongsTo(BobotSoal::class);
    }
}
