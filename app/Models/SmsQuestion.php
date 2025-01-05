<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsQuestion extends Model
{
    use HasFactory;

    protected $guarded = [];

        // Relasi one-to-many dengan CbtSession
        public function cbtSession()
        {
            return $this->belongsTo(CbtSession::class, 'cbt_session_id');
        }

        // Relasi many-to-many dengan Symbols
        public function symbols()
        {
            return $this->belongsToMany(Symbols::class, 'sms_question_images', 'sms_question_id', 'symbol_id')
                        ->withPivot('order') 
                        ->orderByPivot('order')
                        ->withTimestamps();  
        }

    // Relasi one-to-many dengan SmsQuestionImage
    public function images()
    {
        return $this->hasMany(SmsQuestionImage::class, 'sms_question_id');
    }
}

