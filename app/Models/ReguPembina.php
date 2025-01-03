<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReguPembina extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    // ReguPembina.php
public function pembina()
{
    return $this->belongsTo(Pembina::class, 'pembina_id', 'id');
}


    public function peserta(){
        return $this->hasMany(Peserta::class);
    }

    public function upload_lomba(){
        return $this->hasOne(UploadLomba::class);
    }
}
