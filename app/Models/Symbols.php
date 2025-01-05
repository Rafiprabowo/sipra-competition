<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symbols extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function smsQuestions(){
        return $this->belongsToMany(SmsQuestion::class, 'sms_quetion_images', 'symbol_id', 'sms_question_id')
        ->withPivot('order')
        ->withTimestamps();
    }
}
