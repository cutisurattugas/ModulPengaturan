<?php

namespace Modules\Pengaturan\Database\Seeders;

use App\Models\Core\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenuModulPengaturanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Menu::where('modul', 'Pengaturan')->delete();
        $menu = Menu::create([
            'modul' => 'Pengaturan',
            'label' => 'Pengaturan',
            'url' => 'pengaturan',
            'can' => serialize(['admin']),
            'icon' => 'fas fa-cog',
            'urut' => 1,
            'parent_id' => 0,
            'active' => serialize(['pengaturan']),
        ]);
        if ($menu) {
            Menu::create([
                'modul' => 'Pengaturan',
                'label' => 'Unit',
                'url' => 'pengaturan/unit',
                'can' => serialize(['admin']),
                'icon' => 'far fa-circle',
                'urut' => 2,
                'parent_id' => $menu->id,
                'active' => serialize(['pengaturan/unit', 'pengaturan/unit*']),
            ]);
        }
        if ($menu) {
            Menu::create([
                'modul' => 'Pengaturan',
                'label' => 'Pegawai',
                'url' => 'pengaturan/pegawai',
                'can' => serialize(['admin']),
                'icon' => 'far fa-circle',
                'urut' => 3,
                'parent_id' => $menu->id,
                'active' => serialize(['pengaturan/pegawai', 'pengaturan/pegawai*']),
            ]);
        }
        if ($menu) {
            Menu::create([
                'modul' => 'Pengaturan',
                'label' => 'Pejabat',
                'url' => 'pengaturan/pejabat',
                'can' => serialize(['admin']),
                'icon' => 'far fa-circle',
                'urut' => 4,
                'parent_id' => $menu->id,
                'active' => serialize(['pengaturan/pejabat', 'pengaturan/pejabat*']),
            ]);
        }
        if ($menu) {
            Menu::create([
                'modul' => 'Pengaturan',
                'label' => 'Tim Kerja',
                'url' => 'pengaturan/tim-kerja',
                'can' => serialize(['admin']),
                'icon' => 'far fa-circle',
                'urut' => 5,
                'parent_id' => $menu->id,
                'active' => serialize(['pengaturan/tim-kerja', 'pengaturan/tim-kerja*']),
            ]);
        }
    }
}
