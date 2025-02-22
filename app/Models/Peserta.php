<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mata_lomba(){
        return $this->belongsTo(MataLomba::class);
    }
    public function penilaian_karikatur(){
        return $this->hasOne(PenilaianKarikatur::class);
    }

    public function penilaian_pionering(){
        return $this->hasOne(PenilaianPionering::class);
    }

    public function penilaian_duta_logika(){
        return $this->hasOne(PenilaianDutaLogika::class);
    }

    public function penilaian_lkfbb(){
        return $this->hasOne(PenilaianLkfbb::class);
    }

    public function regu_pembina(){
        return $this->belongsTo(ReguPembina::class, 'regu_pembina_id');
    }

    public function upload_lomba(){
        return $this->hasOne(UploadLomba::class);
    }

    public function cbtSessions()
    {
        return $this->belongsToMany(CbtSession::class, 'peserta_sessions')
                    ->withPivot('score', 'status', 'completed_at', 'correct_difficult_answers', 'correct_answer_count')
                    ->withTimestamps();
    }

}
