<?php

namespace Modules\Pengaturan\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Modules\Pengaturan\Entities\Pegawai;

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
         $json = File::get(__DIR__ . '/../../Database/data/pegawai.json');
        $data = json_decode($json);

        foreach ($data->data as $item) {
            DB::table('pegawais')->insert([
                'nip' => $item->nip,
                'nama' => $item->nama,
                'id_staff' => $item->staff,
                'id_jurusan' => $item->jurusan,
                'id_prodi' => $item->prodi,
                'jenis_kelamin' => $item->jenis_kelamin,
                'gelar_dpn' => $item->gelar_dpn,
                'gelar_blk' => $item->gelar_blk,
                'status_karyawan' => $item->status_karyawan,
                'username' => $item->username,
                'noid' => $item->noid,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}