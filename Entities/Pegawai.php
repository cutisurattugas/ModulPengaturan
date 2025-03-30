<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $fillable = ['nip', 'nik', 'nama_lengkap', 'email', 'no_hp', 'alamat', 'golongan_id', 'jabatan_id'];

    public function timKerja()
    {
        return $this->hasMany(TimKerja::class, 'pegawai_id', 'id');
    }

    public function golongan(){
        return $this->belongsTo(Golongan::class, 'golongan_id', 'id');
    }

    public function jabatan(){
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }
}
