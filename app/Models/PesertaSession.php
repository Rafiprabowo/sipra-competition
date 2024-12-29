<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSession extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }

    public function answers(){
        return $this->hasMany(Answer::class, 'peserta_session_id');
    }
}
