<?php

namespace Modules\Pengaturan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pengaturan\Entities\Jabatan;

class JabatanDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $jabatanData = [
            // Jabatan Struktural
            ['nama_jabatan' => 'Direktur', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Wakil Direktur I', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Wakil Direktur II', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Wakil Direktur III', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Ketua Jurusan', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Sekretaris Jurusan', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Koordinator Program Studi', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Kepala Unit', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Kepala Laboratorium', 'tipe_jabatan' => 'Struktural'],
            ['nama_jabatan' => 'Kepala Bagian Administrasi Akademik', 'tipe_jabatan' => 'Struktural'],

            // Jabatan Fungsional
            ['nama_jabatan' => 'Dosen', 'tipe_jabatan' => 'Fungsional'],
            ['nama_jabatan' => 'Asisten Ahli', 'tipe_jabatan' => 'Fungsional'],
            ['nama_jabatan' => 'Lektor', 'tipe_jabatan' => 'Fungsional'],
            ['nama_jabatan' => 'Lektor Kepala', 'tipe_jabatan' => 'Fungsional'],
            ['nama_jabatan' => 'Guru Besar (Profesor)', 'tipe_jabatan' => 'Fungsional'],
            ['nama_jabatan' => 'Instruktur Praktik', 'tipe_jabatan' => 'Fungsional'],
            ['nama_jabatan' => 'Pranata Laboratorium Pendidikan (PLP)', 'tipe_jabatan' => 'Fungsional'],
            ['nama_jabatan' => 'Tenaga Kependidikan', 'tipe_jabatan' => 'Fungsional'],
        ];

        // Masukkan data ke database
        foreach ($jabatanData as $jabatan) {
            Jabatan::create($jabatan);
        }
    }
}
