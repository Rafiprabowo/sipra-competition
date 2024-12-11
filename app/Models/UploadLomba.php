<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadLomba extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }

    public function mataLomba()
    {
        return $this->belongsTo(MataLomba::class);
    }

    public function pembina()
    {
        return $this->belongsTo(Pembina::class);
    }
}
