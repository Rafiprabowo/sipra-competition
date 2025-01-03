<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtSession extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mataLomba(){
        return $this->belongsTo(MataLomba::class, 'mata_lomba_id');
    }

    public function peserta()
    {
        return $this->belongsToMany(Peserta::class, 'peserta_sessions')
                    ->withPivot('score', 'status', 'completed_at')
                    ->withTimestamps();
    }
    
    public function tpk_questions(){
        return $this->hasMany(TpkQuestion::class);
    }

}
