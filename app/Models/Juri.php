<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Juri extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function mata_lomba(){
        return $this->belongsTo(MataLomba::class);
    }
}
