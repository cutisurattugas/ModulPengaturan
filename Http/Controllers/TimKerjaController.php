<?php

namespace Modules\Pengaturan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pengaturan\Entities\Pegawai;
use Modules\Pengaturan\Entities\Pejabat;
use Modules\Pengaturan\Entities\TimKerja;
use Modules\Pengaturan\Entities\Unit;

class TimKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $timKerja = TimKerja::with('ketua', 'unit')
            ->where('parent_id', 1) // anak dari politeknik
            ->get();
        $ketuaUtama = Pejabat::find(1);
        $pejabat = Pejabat::all();
        $parent_id = 1; // id Politeknik Negeri Banyuwangi atau root tim
        $units = Unit::all();

        return view('pengaturan::tim.index', compact('timKerja', 'pejabat', 'parent_id', 'ketuaUtama', 'units'));
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
            'unit_id' => 'required|exists:units,id',
            'ketua_id' => 'required|exists:pegawai,id',
            'parent_id' => 'required|exists:tim_kerja,id'
        ]);
        $tim = TimKerja::create([
            'unit_id' => $request->unit_id,
            'parent_id' => $request->parent_id,
            'ketua_id' => $request->ketua_id
        ]);

        return redirect()->back()->with('success', 'Tim berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $timKerja = TimKerja::with('ketua')
            ->where('parent_id', $id)
            ->get();

        $unitInduk = TimKerja::with('ketua')->findOrFail($id); // Unit yang sedang dibuka
        $ketuaUtama = $unitInduk->ketua; // Bisa null
        $pejabat = Pejabat::all();
        $parent_id = $id;
        $units = Unit::all();

        return view('pengaturan::tim.index', compact('timKerja', 'pejabat', 'parent_id', 'ketuaUtama', 'unitInduk', 'units'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
