<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimKerja extends Model
{
    use HasFactory;

    protected $table = 'tim_kerja';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_unit', 'parent_id', 'ketua_id'];

    public function parent()
    {
        return $this->belongsTo(TimKerja::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(TimKerja::class, 'parent_id');
    }

    public function ketua()
    {
        return $this->belongsTo(Pejabat::class, 'ketua_id');
    }

    public function anggota()
    {
        return $this->belongsToMany(Pegawai::class, 'tim_kerja_anggota', 'tim_kerja_id', 'pegawai_id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('ketua', 'childrenRecursive');
    }
}
