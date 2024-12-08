<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateDokumen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function upload_dokumen()
    {
        return $this->hasMany(UploadDokumen::class);
    }
}
