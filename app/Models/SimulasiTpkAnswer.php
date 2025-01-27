<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulasiTpkAnswer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function simulasiTpkQuestion(){
        return $this->belongsTo(SimulasiTpkQuestion::class, 'simulasi_tpk_question_id');
    }
}
