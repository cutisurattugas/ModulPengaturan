<?php

namespace Modules\Pengaturan\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PengaturanDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(MenuModulPengaturanTableSeeder::class);
        $this->call(GolonganDataTableSeeder::class);
        $this->call(JabatanDataTableSeeder::class);
        $this->call(PegawaiDataTableSeeder::class);
    }
}
