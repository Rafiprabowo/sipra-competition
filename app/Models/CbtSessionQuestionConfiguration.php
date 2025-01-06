<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtSessionQuestionConfiguration extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cbtSession(){
        return $this->belongsTo(CbtSession::class, 'cbt_session_id');
    }
}
