<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianLkfbb extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function bobot_soal(){
        return $this->belongsTo(BobotSoal::class);
    }
}
