<?php

namespace Modules\Pengaturan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pengaturan\Entities\Pegawai;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $pegawai = Pegawai::paginate(10);
        return view('pengaturan::pegawai.index', compact('pegawai'));
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
        ]);

        Pegawai::create([
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
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
        ]);

        $pegawai = Pegawai::findOrFail($id);

        // Update data pegawai
        $pegawai->update([
            'nip' => $request->nip,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
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
