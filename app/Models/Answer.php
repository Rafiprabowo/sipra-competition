<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function peserta(){
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }

    public function exam(){
        return $this->belongsTo(Exam::class, 'exam_id');
    }
    public function tpk_question(){
        return $this->belongsTo(TpkQuestion::class, 'tpk_question_id');
    }
}
