<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulasiSmsQuestionImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function symbol(){
        return $this->belongsTo(Symbols::class, 'symbol_id');
    }

    public function SimulasiSmsQuestion(){
        return $this->belongsTo(SimulasiSmsQuestion::class, 'simulasi_sms_question_id');
    }
}
