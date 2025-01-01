<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianFoto extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pembina()
    {
        $this->belongsTo(Pembina::class);
    }
    public function juri(){
        $this->belongsTo(Juri::class);
    }
    public function mata_lomba(){
        return $this->belongsTo(MataLomba::class);
    }
    public function bobot_soal(){
        return $this->belongsTo(BobotSoal::class);
    }
}
