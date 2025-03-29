<?php

namespace Modules\Pengaturan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pengaturan\Entities\Golongan;

class GolonganDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $golonganData = [
            ['nama_golongan' => 'I/a', 'deskripsi' => 'Juru Muda'],
            ['nama_golongan' => 'I/b', 'deskripsi' => 'Juru Muda Tingkat I'],
            ['nama_golongan' => 'I/c', 'deskripsi' => 'Juru'],
            ['nama_golongan' => 'I/d', 'deskripsi' => 'Juru Tinggi'],
            ['nama_golongan' => 'II/a', 'deskripsi' => 'Pengatur Muda'],
            ['nama_golongan' => 'II/b', 'deskripsi' => 'Pengatur Muda Tingkat I'],
            ['nama_golongan' => 'II/c', 'deskripsi' => 'Pengatur'],
            ['nama_golongan' => 'II/d', 'deskripsi' => 'Pengatur Tinggi'],
            ['nama_golongan' => 'III/a', 'deskripsi' => 'Penata Muda'],
            ['nama_golongan' => 'III/b', 'deskripsi' => 'Penata Muda Tingkat I'],
            ['nama_golongan' => 'III/c', 'deskripsi' => 'Penata'],
            ['nama_golongan' => 'III/d', 'deskripsi' => 'Penata Tinggi'],
            ['nama_golongan' => 'IV/a', 'deskripsi' => 'Pembina'],
            ['nama_golongan' => 'IV/b', 'deskripsi' => 'Pembina Tingkat I'],
            ['nama_golongan' => 'IV/c', 'deskripsi' => 'Pembina Utama Muda'],
            ['nama_golongan' => 'IV/d', 'deskripsi' => 'Pembina Utama Madya'],
            ['nama_golongan' => 'IV/e', 'deskripsi' => 'Pembina Utama'],
        ];

        // Masukkan data ke database
        foreach ($golonganData as $golongan) {
            Golongan::create($golongan);
        }
    }
}
