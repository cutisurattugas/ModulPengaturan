<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_jabatan', 'tipe_jabatan'];

    public function pejabat()
    {
        return $this->hasMany(Pejabat::class, 'jabatan_id', 'id');
    }
}