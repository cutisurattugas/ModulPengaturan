@extends('adminlte::page')
@section('title', 'Tim')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Tim</h1>
                    <div class="lead d-flex flex-wrap justify-content-start" style="gap: 5px;">
                        <a href="#" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modalTambahTim">
                            <i class="nav-icon fas fa-plus"></i>
                            Tambah Tim Kerja
                        </a>
                        <a href="#" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modalTambahTim">
                            <i class="nav-icon fas fa-user-plus"></i>
                            Tambah Ketua
                        </a>
                        <a href="#" class="btn btn-primary btn-sm mb-2" data-toggle="modal"
                            data-target="#modalTambahTim">
                            <i class="nav-icon fas fa-user-plus"></i>
                            Tambah Anggota
                        </a>
                        <a href="#" class="btn btn-info btn-sm mb-2" data-toggle="modal"
                            data-target="#modalTambahTim">
                            <i class="nav-icon fas fa-user-plus"></i>
                            Tambah Anggota (Bulk)
                        </a>
                        <a href="#" class="btn btn-danger btn-sm mb-2" data-toggle="modal"
                            data-target="#modalTambahTim">
                            <i class="nav-icon fas fa-user-minus"></i>
                            Belum Punya Tim
                        </a>
                    </div>
                    <div class="mt-2">
                        @include('layouts.partials.messages')
                    </div>

                    <table class="table table-bordered">
                        <!-- Root Tim Kerja -->
                        <tr>
                            <th width="1%"><i class="nav-icon fas fa-folder-open"></i></th>
                            <th colspan="2">{{ $unitInduk->unit->nama ?? 'Politeknik Negeri Banyuwangi' }}</th>

                            <th>
                                <center>
                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditPegawai">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </a>
                                    <form action="#" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm delete-btn">
                                            <i class="nav-icon fas fa-trash"></i>
                                        </button>
                                    </form>
                                </center>
                            </th>
                        </tr>

                        <!-- Ketua Utama -->
                        @if ($ketuaUtama)
                            <tr>
                                <td></td>
                                <td width="1%">
                                    <center><i class="nav-icon fas fa-user"></i></center>
                                </td>
                                <td>
                                    {{ $ketuaUtama->pegawai->nama_lengkap }} [Ketua] <br>
                                    <small>
                                        {{ $ketuaUtama->pegawai->nip }} |
                                        {{ $ketuaUtama->jabatan->nama_jabatan }} |
                                        Sudah Buat SKP dengan Peran Ini
                                    </small>
                                </td>
                                <td width="10%">
                                    <center>
                                        <a class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalEditPegawai">
                                            <i class="nav-icon fas fa-star"></i>
                                        </a>
                                        <form action="#" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="nav-icon fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </center>
                                </td>
                            </tr>
                        @endif

                        <!-- Tim-Tim Kerja Anak -->
                        @foreach ($timKerja as $tim)
                            <tr>
                                <td></td>
                                <td width="1%">
                                    <center><i class="nav-icon fas fa-folder"></i></center>
                                </td>
                                <td>
                                    <a href="{{ route('tim.show', $tim->id) }}">{{ $tim->unit->nama }}</a>

                                </td>
                                <td>
                                    <center>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEditPegawai">
                                            <i class="nav-icon fas fa-edit"></i>
                                        </a>
                                        <form action="#" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                                <i class="nav-icon fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <br>
                    <div class="d-flex">
                        {{-- {!! $pegawai->links('pagination::bootstrap-4') !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Tim Kerja -->
    <div class="modal fade" id="modalTambahTim" tabindex="-1" role="dialog" aria-labelledby="modalTambahTimLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('tim.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Tim Kerja</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Parent Unit -->
                        <div class="form-group">
                            <label>Parent</label>
                            <input type="text" class="form-control"
                                value="{{ $unitInduk->nama_unit ?? 'Politeknik Negeri Banyuwangi' }}" readonly>
                            <input type="hidden" name="parent_id" value="{{ $parent_id ?? 1 }}">
                        </div>

                        <!-- Nama Tim -->
                        <div class="form-group">
                            <label>Nama Tim</label>
                            <select class="form-control" name="unit_id">
                                <option value="">- Pilih Unit -</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ketua Tim -->
                        <div class="form-group">
                            <label>Ketua Tim</label>
                            <select name="ketua_id" class="form-control" required>
                                <option value="">- Pilih Ketua -</option>
                                @foreach ($pejabat as $p)
                                    <option value="{{ $p->id }}">{{ $p->pegawai->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop
@section('adminlte_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function(e) {
                    e.preventDefault(); // Cegah form terkirim langsung

                    let form = this.closest("form");

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Data yang dihapus tidak bisa dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "Ya, hapus!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit(); // Kirim form jika dikonfirmasi
                        }
                    });
                });
            });
        });
    </script>
@stop
