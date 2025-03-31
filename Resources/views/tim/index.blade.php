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
                        <tr>
                            <th width="1%">
                                <i class="nav-icon fas fa-folder-open"></i>
                            </th>
                            <th colspan="2">
                                Politeknik Negeri Banyuwangi
                            </th>
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
                        <tr>
                            <td>
                            </td>
                            <td width="1%">
                                <center><i class="nav-icon fas fa-user"></i></center>
                            </td>
                            <td>
                                M. Shofi`ul Amin [Ketua] <br>
                                <small>
                                    198605212015041002 |
                                    Direktur Politeknik Negeri Banyuwangi |
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
                        <tr>
                            <td>
                            </td>
                            <td width="1%">
                                <center><i class="nav-icon fas fa-folder"></i></center>
                            </td>
                            <td>
                                <a href="#">Satuan Pengawas Internal</a>
                            </td>
                            <td>
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
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <center><i class="nav-icon fas fa-folder"></i></center>
                            </td>
                            <td>
                                <a href="#">Wakil Direktur Bidang Akademik</a>
                            </td>
                            <td>
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
                            </td>
                        </tr>
                    </table>
                    <br>
                    <div class="d-flex">
                        {{-- {!! $pegawai->links('pagination::bootstrap-4') !!} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Pegawai -->
    {{-- <div class="modal fade" id="modalTambahPegawai" tabindex="-1" role="dialog"
        aria-labelledby="modalTambahPegawaiLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('pegawai.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPegawaiLabel">Tambah Pegawai Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Kolom 1 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control"
                                        placeholder="Masukkan Nama Lengkap Pegawai" required>
                                </div>
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" class="form-control"
                                        placeholder="Masukkan NIP Pegawai" required
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="text" name="nik" class="form-control"
                                        placeholder="Masukkan NIK Pegawai" required
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                </div>
                                <div class="form-group">
                                    <label for="golongan_id">Golongan</label>
                                    <select name="golongan_id" class="form-control" required>
                                        <option value="">-- Pilih Golongan --</option>
                                        @foreach ($golongan as $g)
                                            <option value="{{ $g->id }}">{{ $g->nama_golongan }} -
                                                {{ $g->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Kolom 2 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Masukkan Email Pegawai" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" name="no_hp" class="form-control"
                                        placeholder="Masukkan No HP Pegawai" required
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                                </div>
                                <div class="form-group">
                                    <label for="jabatan_id">Jabatan</label>
                                    <select name="jabatan_id" class="form-control" required>
                                        <option value="">-- Pilih Jabatan --</option>
                                        @foreach ($jabatan as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat Pegawai" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
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
