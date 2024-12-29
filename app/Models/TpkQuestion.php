<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpkQuestion extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function cbt_session(){
        return $this->belongsTo(CbtSession::class, 'cbt_session_id');
    }
}
