<?php

namespace Modules\Pengaturan\Entities;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Penilaian\Entities\Cascading;
use Modules\Penilaian\Entities\RencanaKerja;

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
        return $this->hasMany(TimKerja::class, 'tim_kerja_anggota', 'pegawai_username')->withPivot('peran');
    }

    public function timKerjaAnggota()
    {
        return $this->belongsToMany(TimKerja::class, 'tim_kerja_anggota', 'pegawai_username', 'tim_kerja_id', 'username',                  // primary key lokal (model Pegawai)
        'id')->withPivot('peran');
    }

    public function anggota(){
        return $this->hasOne(Anggota::class, 'pegawai_username', 'username');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pejabat(){
        return $this->hasOne(Pejabat::class);
    }

    public function rencanakerja(){
        return $this->hasMany(RencanaKerja::class, 'pegawai_username', 'username');
    }

    public function timKerjaKetua(){
        return $this->belongsToMany(TimKerja::class, 'tim_kerja_anggota')
            ->wherePivot('peran', 'Ketua');
    }

    public function bawahan(){
        return $this->timKerjaKetua()
            ->with('anggota')
            ->get()
            ->pluck('anggota')
            ->flatten()
            ->unique('id')
            ->values();
    }

    public function cascading()
    {
        return $this->hasMany(Cascading::class, 'pegawai_username', 'username');
    }
}
