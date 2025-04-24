<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pejabat extends Model
{
    use HasFactory;

    protected $table = 'pejabat';
    protected $primaryKey = 'id';
    protected $fillable = ['periode_mulai', 'periode_selesai', 'status', 'sk', 'pegawai', 'nip', 'unit_id', 'jabatan_id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    public function timKerja()
    {
        return $this->hasMany(TimKerja::class, 'pejabat_id', 'id');
    }
}
