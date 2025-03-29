<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $primaryKey = 'id';
    protected $fillable = ['nip', 'nik', 'nama_lengkap', 'email', 'no_hp', 'alamat'];

    public function timKerja()
    {
        return $this->hasMany(TimKerja::class, 'pegawai_id', 'id');
    }
}
