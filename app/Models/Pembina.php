<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function regu()
    {
        return $this->hasMany(ReguPembina::class);
    }

    public function upload_dokumen()
    {
        return $this->hasOne(UploadDokumen::class);
    }
    public function finalisasi(){
        return $this->hasOne(Finalisasi::class);
    }

    public function upload_lomba(){
        return $this->hasOne(UploadLomba::class);
    }    
    
}
