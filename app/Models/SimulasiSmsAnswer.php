<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulasiSmsAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function simulasiQuestionImage(){
        return $this->belongsTo(SimulasiSmsQuestionImage::class, 'simulasi_sms_question_image_id');
    }
}
