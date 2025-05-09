<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';
    protected $primaryKey = 'id';
    protected $fillable = ['jabatan', 'role'];

    public function pejabat()
    {
        return $this->hasMany(Pejabat::class, 'jabatan_id', 'id');
    }
}