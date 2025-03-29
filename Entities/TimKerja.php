<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimKerja extends Model
{
    use HasFactory;

    protected $table = 'tim_kerja';
    protected $primaryKey = 'id';
    protected $fillable = ['unit_id', 'pejabat_id', 'pegawai_id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function pejabat()
    {
        return $this->belongsTo(Pejabat::class, 'pejabat_id', 'id');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id', 'id');
    }
}
