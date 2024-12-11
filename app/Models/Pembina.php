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
        return $this->hasMany(UploadDokumen::class,'pembina_id');
    }
    public function finalisasi(){
        return $this->hasOne(Finalisasi::class);
    }

}
