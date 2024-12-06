<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadDokumen extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function pembina(){
        return $this->belongsTo(Pembina::class);
    }
}
