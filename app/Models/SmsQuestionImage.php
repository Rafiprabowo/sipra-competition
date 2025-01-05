<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsQuestionImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function symbol(){
        return $this->belongsTo(Symbols::class, 'symbol_id');
    }

    public function smsQuestion(){
        return $this->belongsTo(SmsQuestion::class, 'sms_question_id');
    }
}
