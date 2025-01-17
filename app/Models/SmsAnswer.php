<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsAnswer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questionImage(){
        return $this->belongsTo(SmsQuestionImage::class, 'sms_question_image_id');
    }

    public function peserta(){
        return $this->belongsTo(Peserta::class, 'peserta_id');
    }

    public function smsQuestion()
    {
        return $this->belongsTo(SmsQuestion::class, 'sms_question_id');
    }

    public function cbtSession()
    {
        return $this->belongsTo(CbtSession::class, 'cbt_session_id');
    }

}
