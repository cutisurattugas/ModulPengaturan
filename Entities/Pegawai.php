<?php

namespace Modules\Pengaturan\Entities;

use App\Models\Core\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Penilaian\Entities\Cascading;
use Modules\Cuti\Entities\Cuti;
use Modules\Penilaian\Entities\RencanaKerja;
use Modules\SuratTugas\Entities\AnggotaSuratTugas;
use Modules\SuratTugas\Entities\SuratTugas;
use Modules\SuratTugas\Entities\SuratTugasAnggota;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';
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
        return $this->belongsToMany(TimKerja::class, 'tim_kerja_anggota', 'pegawai_id', 'tim_kerja_id')->withPivot('peran');
    }

    public function anggota(){
        return $this->hasOne(Anggota::class, 'pegawai_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }

    public function pejabat()
    {
        return $this->hasOne(Pejabat::class);
    }

    public function rencanakerja(){
        return $this->hasMany(RencanaKerja::class, 'pegawai_id', 'id');
    }

    public function timKerjaKetua()
    {
        return $this->belongsToMany(TimKerja::class, 'tim_kerja_anggota')
            ->wherePivot('peran', 'Ketua');
    }

    public function bawahan()
    {
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
        return $this->hasMany(Cascading::class, 'pegawai_id', 'id');
    }
    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'pegawai_id');
    }

    public function suratTugas()
    {
        return $this->hasManyThrough(SuratTugas::class, AnggotaSuratTugas::class, 'pegawai_id', 'id', 'id', 'surat_tugas_id');
    }
}
