<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tpk_question(){
        return $this->belongsTo(TpkQuestion::class, 'tpk_question_id');
    }

    public function peserta(){
        return $this->belongsTo(PesertaSession::class, 'peserta_session_id');
    }
}
