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
        return $this->belongsTo(Pembina::class, 'pembina_id');
    }
    public function juri(){
        return $this->belongsTo(Juri::class, 'juri_id');
    }
    public function mata_lomba(){
        return $this->belongsTo(MataLomba::class, 'mata_lomba_id');
    }
    public function bobot_soal(){
        return $this->belongsTo(BobotSoal::class, 'bobot_soal_id');
    }
}
