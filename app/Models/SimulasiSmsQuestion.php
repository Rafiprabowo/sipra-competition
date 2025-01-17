<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulasiSmsQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];

        // Relasi many-to-many dengan Symbols
        public function symbols()
        {
            return $this->belongsToMany(Symbols::class, 'simulasi_sms_question_images', 'simulasi_sms_question_id', 'symbol_id')
                        ->withPivot('order') 
                        ->orderByPivot('order')
                        ->withTimestamps();  
        }

    // Relasi one-to-many dengan SmsQuestionImage
    public function images()
    {
        return $this->hasMany(SimulasiSmsQuestionImage::class, 'simulasi_sms_question_id');
    }
}
