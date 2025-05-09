<?php

namespace Modules\Pengaturan\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Modules\Pengaturan\Entities\Jabatan;
use Modules\Pengaturan\Entities\Pegawai;
use Modules\Pengaturan\Entities\Pejabat;
use Modules\Pengaturan\Entities\Unit;

class PejabatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $unit = Unit::all();
        $jabatan = Jabatan::all();
        $pejabat = Pejabat::paginate(10);
        $pegawai = Pegawai::orderBy('nama', 'asc')->get();

        return view('pengaturan::pejabat.index', compact('pejabat', 'pegawai', 'jabatan', 'unit'));
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
            'pegawai_id' => 'required|exists:pegawais,id',
            'mulai' => 'required|date',
            'selesai' => 'nullable|date|after_or_equal:mulai',
            'status' => 'required|in:Aktif,Non Aktif',
            'jabatan_id' => 'required|exists:jabatans,id',
            'SK' => 'required|file|mimes:pdf|max:2048',
            'unit_id' => 'nullable|exists:units,id',
        ]);

        if ($request->hasFile('SK')) {
            $file = $request->file('SK');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/SK', $fileName, 'public');
        } else {
            return back()->with('error', 'File SK wajib diunggah.');
        }

        Pejabat::create([
            'pegawai_id' => $request->pegawai_id,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => $request->status,
            'unit_id' => $request->unit_id,
            'jabatan_id' => $request->jabatan_id,
            'SK' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Pejabat berhasil ditambahkan.');
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
        $pejabat = Pejabat::findOrFail($id);

        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'mulai' => 'required|date',
            'selesai' => 'nullable|date|after_or_equal:mulai',
            'status' => 'required|in:Aktif,Non Aktif',
            'jabatan_id' => 'required|exists:jabatans,id',
            'SK' => 'nullable|file|mimes:pdf|max:2048', // Tidak wajib mengunggah ulang file
            'unit_id' => 'nullable|exists:units,id',
        ]);

        $data = [
            'pegawai_id' => $request->pegawai_id,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => $request->status,
            'unit_id' => $request->unit_id,
            'jabatan_id' => $request->jabatan_id,
        ];

        // Update file SK jika ada yang baru
        if ($request->hasFile('SK')) {
            // Hapus file lama jika ada
            if ($pejabat->SK && Storage::exists('public/' . $pejabat->SK)) {
                Storage::delete('public/' . $pejabat->SK);
            }

            // Upload file baru
            $file = $request->file('SK');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/SK', $fileName, 'public');

            $data['SK'] = $filePath;
        }

        // Update data ke database
        $pejabat->update($data);

        return redirect()->back()->with('success', 'Data Pejabat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $pejabat = Pejabat::findOrFail($id);
        $pejabat->delete();
        return redirect()->back()->with('success', 'Data Pejabat berhasil dihapus.');
    }
}
