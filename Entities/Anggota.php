<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'tim_kerja_anggota';
    protected $fillable = [
        'tim_kerja_id',
        'pegawai_id',
    ];

    public function timKerja()
    {
        return $this->belongsTo(TimKerja::class, 'tim_kerja_id', 'id');
    }

    public function pegawai(){
        return $this->belongsTo(Pegawai::class);
    }
}
