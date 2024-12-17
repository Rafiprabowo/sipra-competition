<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tpk_questions()
{
    return $this->belongsToMany(TpkQuestion::class, 'exam_questions', 'exam_id', 'question_id')
                ->withPivot('order')
                ->orderBy('pivot_order');
}


    public function answers(){
        return $this->hasMany(Answer::class);
    }

}
