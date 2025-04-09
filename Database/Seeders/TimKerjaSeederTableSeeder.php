<?php

namespace Modules\Pengaturan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Pengaturan\Entities\TimKerja;

class TimKerjaSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimKerja::firstOrCreate(
            ['id' => 1],
            [
                'nama_unit' => 'Politeknik Negeri Banyuwangi',
                'ketua_id' => 1, // pastikan ini valid
                'parent_id' => null
            ]
        );
    }
}
