<?php

namespace Modules\Pengaturan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pengaturan\Entities\Golongan;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $gol = Golongan::orderBy('nama_golongan', 'asc')->paginate(10);
        return view('pengaturan::golongan.index', compact('gol'));
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
            'nama_golongan' => 'required|string|max:255',
            'deskripsi' => 'required',
        ]);

        Golongan::create([
            'nama_golongan' => $request->nama_golongan,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->back()->with('success', 'Golongan berhasil ditambahkan!');
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
        
        $gol = Golongan::findOrFail($id);
        $gol->update([
            'nama_golongan' => $request->nama_golongan,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->back()->with('success', 'Golongan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $gol = Golongan::findOrFail($id);
        $gol->delete();
        return redirect()->back()->with('success', 'Golongan berhasil dihapus!');
    }
}
