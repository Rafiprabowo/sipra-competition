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

    public function penilaian_pioneering(){
        return $this->hasMany(PenilaianPioneering::class);
    }
}
