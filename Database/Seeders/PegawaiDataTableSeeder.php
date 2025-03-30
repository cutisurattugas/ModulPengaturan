<?php

namespace Modules\Pengaturan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PegawaiDataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('pegawai')->insert([
            [
                'nip' => '1987010120221001',
                'nik' => '3201234567890001',
                'nama_lengkap' => 'Ahmad Pratama',
                'email' => 'ahmad.pratama@example.com',
                'no_hp' => '081234567891',
                'alamat' => 'Jl. Merdeka No. 10, Jakarta',
                'golongan_id' => '14',
                'jabatan_id' => '13',
            ],
            [
                'nip' => '1987020220221002',
                'nik' => '3201234567890002',
                'nama_lengkap' => 'Dewi Lestari',
                'email' => 'dewi.lestari@example.com',
                'no_hp' => '082345678912',
                'alamat' => 'Jl. Sudirman No. 20, Bandung',
                'golongan_id' => '12',
                'jabatan_id' => '13',
            ],
            [
                'nip' => '1987030320221003',
                'nik' => '3201234567890003',
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'no_hp' => '083456789123',
                'alamat' => 'Jl. Ahmad Yani No. 30, Surabaya',
                'golongan_id' => '11',
                'jabatan_id' => '13',
            ],
            [
                'nip' => '1987040420221004',
                'nik' => '3201234567890004',
                'nama_lengkap' => 'Siti Rahmawati',
                'email' => 'siti.rahmawati@example.com',
                'no_hp' => '084567891234',
                'alamat' => 'Jl. Diponegoro No. 40, Yogyakarta',
                'golongan_id' => '11',
                'jabatan_id' => '13',
            ],
        ]);
    }
}
