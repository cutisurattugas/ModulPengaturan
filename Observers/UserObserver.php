<?php
namespace Modules\Pengaturan\Observers;

use App\Models\Core\User;
use Modules\Pengaturan\Entities\Pegawai;

class UserObserver {
    public function created(User $user)
    {
        // Misalnya cek apakah ada pegawai yang cocok via email
        $pegawai = Pegawai::where('username', $user->username)->first();

        if ($pegawai && is_null($pegawai->user_id)) {
            $pegawai->user_id = $user->id;
            $pegawai->save();
        }
    }
}


?>
