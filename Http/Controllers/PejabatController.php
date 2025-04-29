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
        $jabatan = Jabatan::where('tipe_jabatan', 'Struktural')->get();
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
            'pegawai_id' => 'required',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date|after_or_equal:periode_mulai',
            'status' => 'required|boolean',
            'jabatan_id' => 'required|exists:jabatan,id',
            'sk' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('sk')) {
            $file = $request->file('sk');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/sk', $fileName, 'public');
        } else {
            return back()->with('error', 'File SK wajib diunggah.');
        }

        Pejabat::create([
            'pegawai_id' => $request->pegawai_id,
            'nip' => Pegawai::where('id', $request->pegawai_id)->first()->nip ?? '-',
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
            'unit_id' => $request->unit_id,
            'jabatan_id' => $request->jabatan_id,
            'sk' => $filePath,
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
            'pegawai_id' => 'required',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'nullable|date',
            'status' => 'required|in:0,1',
            'unit_id' => 'nullable|exists:units,id',
            'jabatan_id' => 'required|exists:jabatan,id',
            'sk' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = [
            'pegawai_id' => $request->pegawai_id,
            'nip' => Pegawai::where('id', $request->pegawai_id)->first()->nip ?? '-',
            'periode_mulai' => $request->periode_mulai,
            'periode_selesai' => $request->periode_selesai,
            'status' => $request->status,
            'unit_id' => $request->unit_id,
            'jabatan_id' => $request->jabatan_id,
        ];

        if ($request->hasFile('sk')) {
            if ($pejabat->sk && Storage::exists('public/uploads/sk/' . $pejabat->sk)) {
                Storage::delete('public/uploads/sk/' . $pejabat->sk);
            }

            $file = $request->file('sk');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/sk', $fileName);
            $data['sk'] = 'uploads/sk/' . $fileName;
        }

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
