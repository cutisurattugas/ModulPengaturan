<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nip',
        'nama',
        'staff',
        'jurusan',
        'prodi',
        'jenis_kelamin',
        'gelar_dpn',
        'gelar_blk',
        'status_karyawan',
        'username',
        'noid',
    ];

    public function timKerja()
    {
        return $this->hasMany(TimKerja::class, 'pegawai_id', 'id');
    }

    public function timKerjaAnggota()
    {
        return $this->belongsToMany(TimKerja::class, 'tim_kerja_anggota', 'pegawai_id', 'tim_kerja_id');
    }
}
