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
        $allTimKerja = TimKerja::with('unit')->get();

        return view('pengaturan::tim.index', compact('timKerja', 'pejabat', 'parent_id', 'ketuaUtama', 'units', 'allTimKerja'));
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

    public function getChildren($id)
    {
        $children = TimKerja::with(['unit', 'ketua.pegawai', 'ketua.jabatan'])->where('parent_id', $id)->get();
        $unitInduk = TimKerja::with(['ketua.pegawai', 'ketua.jabatan'])->find($id);

        $html = '';
        if ($unitInduk) {
            $html .= '<div class="border rounded p-2 mb-3">';
            $html .= '<div class="d-flex justify-content-between align-items-start">';
            $html .= '<div>';
            if ($unitInduk->ketua) {
                $html .= $unitInduk->ketua->pegawai->nama_lengkap . ' [Ketua] <br>';
                $html .= '<small>' . $unitInduk->ketua->pegawai->nip . ' | ' . ($unitInduk->ketua->jabatan->nama_jabatan ?? '-') . ' | Sudah Buat SKP dengan Peran Ini</small>';
            } else {
                $html .= '<em>Belum ada ketua</em>';
            }
            $html .= '</div>';
            $html .= '<div>';
            $html .= '<a class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEditPegawai"> <i class="fas fa-star"></i></a>';
            $html .= '<form action="#" method="POST" class="d-inline delete-form" onsubmit="return confirm(\'Yakin ingin menghapus?\')">' . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash"></i></button></form>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
        }

        // Menampilkan tim kerja anak-anak
        foreach ($children as $child) {
            $html .= '<div class="border rounded p-2 mb-1">';
            $html .= '<div class="d-flex justify-content-between align-items-start">';

            // KIRI: Nama Unit Anak
            $html .= '<div>';
            $html .= '<a href="javascript:void(0)" class="toggle-child" data-id="' . $child->id . '">';
            $html .= '<strong>' . $child->unit->nama . '</strong>';
            $html .= '</a>';
            $html .= '</div>';

            // KANAN: Tombol Aksi
            $html .= '<div>';
            $html .= '<a class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#modalEditPegawai">
            <i class="fas fa-edit"></i>
          </a>';
            $html .= '<form action="#" method="POST" class="d-inline delete-form" onsubmit="return confirm(\'Yakin ingin menghapus?\')">
            ' . csrf_field() . method_field('DELETE') . '
            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                <i class="fas fa-trash"></i>
            </button>
          </form>';
            $html .= '</div>';

            $html .= '</div>'; // close d-flex
            $html .= '<div class="children-container mt-2" id="child-container-' . $child->id . '"></div>';
            $html .= '</div>'; // close border box

        }

        return response()->json([
            'status' => 'ok',
            'html' => $html,  // Mengirimkan HTML yang telah dirender
        ]);
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
