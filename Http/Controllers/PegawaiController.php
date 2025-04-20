<?php

namespace Modules\Pengaturan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Modules\Pengaturan\Entities\Golongan;
use Modules\Pengaturan\Entities\Jabatan;
use Modules\Pengaturan\Entities\Pegawai;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try {
            $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzdlNTg2NzdjMjExOGZlZmQ5M2JjOTQzMWE0NzEyYzJhZDE4MDIwNTkyY2IwYzU5YzlhMTQyYWVmNDU0YTMxNTY1M2U3M2NlNGZlNWFmZDkiLCJpYXQiOjE3NDE1ODg0OTQuOTgzNDE5LCJuYmYiOjE3NDE1ODg0OTQuOTgzNDI5LCJleHAiOjE3NzMxMjQ0OTQuODI0NTc0LCJzdWIiOiI5MTYiLCJzY29wZXMiOlsicmVhZG9ubHkiXX0.r5mIeRDLDbEr-jyORFuWt4pKpwtQ8guJHWkVcCB0XALpe4CLkX-HA_aA_kK1un0sybGxFAwDv86iqwVIQhII7d9sVv_b9_xJzqbPWu7LOGJ1lNiFueDpTrCc851DBuE8DCKmMHMX80kNc_jgTTLfpBBe0BR1FRyGi39dhwdhiTmxUxwpvwaD_rHbt6OKFRHohRTsHkP-A2SCVBkHRiTEYcCiaJBjyduL2LFvSgy9Lk4NRhiB_2Qmv-Mlg6juGEvDyqZUx5779_FWk2eT13xVDRklX3j9ErbA1dUg0p2eUcxnvjae3kPxN7HCcilK2nut1b3qXmGVu_OXcBrw7buJWM5q72oKjwsxQujIcDjUB4ar_SpLLZ8mFHq5zqgp9dH1Gyy5RZ2yBeXLGBzt2Hru3hnESdRalFAi2hlySJO-0fiqdE8mIvL4nl9AP6J_VZseqhP-gUV0VbeEiP3Tq5bj-9LHjcWkdpWaRMUyLXGzSL6iiOh_kyDlNrUIAZJuiMDt3ecIvowET9_t2huUJoJJkUhqPfGnllWmQmlOG5gjnGA8HzW4qXq-Bo2pM1zP7uBTZe4Qgv-JYiaVnCfv9KRksjz_Fy9cWTnqSJHFoyRmJOtfO93MnU7nuf2GyWNexafAY4xD9DmFVYKX8wB8rO7eB2S_2WRueQ3M6oojVzB829E';

            $page = $request->query('page', 1);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get("https://sit.poliwangi.ac.id/v2/api/v1/sitapi/pegawai?page%5Bnumber%5D=$page");

            if ($response->successful()) {
                $result = $response->json();

                return view('pengaturan::pegawai.index', [
                    'pegawai' => $result['data'],
                    'links' => $result['links'],
                    'currentPage' => $result['current_page'],
                    'lastPage' => $result['last_page']
                ]);
            } else {
                return view('pengaturan::pegawai.index')->with('error', 'Gagal mengambil data dari API');
            }
        } catch (\Exception $e) {
            return view('pengaturan::pegawai.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('pengaturan::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:pegawai,nip|max:20',
            'nik' => 'required|unique:pegawai,nik|max:16',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:500',
            'golongan_id' => 'required|string|max:255',
            'jabatan_struktural_id' => 'nullable|string|max:255',
            'jabatan_fungsional_id' => 'nullable|string|max:255',
        ]);

        Pegawai::create([
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'golongan_id' => $request->golongan_id,
            'jabatan_struktural_id' => $request->jabatan_struktural_id,
            'jabatan_fungsional_id' => $request->jabatan_fungsional_id,
        ]);

        return redirect()->back()->with('success', 'Pegawai berhasil ditambahkan!');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('pengaturan::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('pengaturan::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|max:20|unique:pegawai,nip,' . $id,
            'nik' => 'required|max:16|unique:pegawai,nik,' . $id,
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pegawai,email,' . $id,
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:500',
            'golongan_id' => 'required|string|max:255',
            'jabatan_struktural_id' => 'nullable|string|max:255',
            'jabatan_fungsional_id' => 'nullable|string|max:255',
        ]);

        $pegawai = Pegawai::findOrFail($id);

        $pegawai->update([
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'golongan_id' => $request->golongan_id,
            'jabatan_struktural_id' => $request->jabatan_struktural_id,
            'jabatan_fungsional_id' => $request->jabatan_fungsional_id,
        ]);

        return redirect()->back()->with('success', 'Data pegawai berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        return redirect()->back()->with('success', 'Data pegawai berhasil dihapus');
    }
}
