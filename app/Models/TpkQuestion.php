<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpkQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function exams() {
        return $this->belongsToMany(Exam::class, 'exam_questions', 'question_id', 'exam_id')->withPivot('order');
    }

    public function answers() {
        return $this->hasMany(Answer::class);
    }
}