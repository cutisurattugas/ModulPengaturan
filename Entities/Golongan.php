<?php

namespace Modules\Pengaturan\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Golongan extends Model
{
    use HasFactory;

    protected $table = 'golongan';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_golongan', 'deskripsi'];
    
}
