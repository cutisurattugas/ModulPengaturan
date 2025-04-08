@extends('adminlte::page')
@section('title', 'Pegawai')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Pegawai</h1>
                    <div class="lead">
                        Manaje Pegawai.
                        <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#modalTambahPegawai">Tambah Pegawai</a>

                    </div>

                    <div class="mt-2">
                        @include('layouts.partials.messages')
                    </div>

                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle; text-align: center; width: 40px;">No</th>
                                <th rowspan="2" class="text-center align-middle">Nama</th>
                                <th rowspan="2" class="text-center align-middle">NIP</th>
                                <th rowspan="2" class="text-center align-middle">Golongan</th>
                                <th rowspan="2" class="text-center align-middle">No HP</th>
                                <th colspan="2" class="text-center">Jabatan</th>
                                <th rowspan="2" class="text-center align-middle">Opsi</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="width: 120px;">Struktural</th>
                                <th class="text-center" style="width: 120px;">Fungsional</th>
                            </tr>
                        </thead>
                        @foreach ($pegawai as $item)
                            <tr>
                                <td>
                                    <center>{{ $loop->iteration }}</center>
                                </td>
                                <td>
                                    {{ $item->nama_lengkap }}
                                </td>
                                <td>
                                    {{ $item->nip }}
                                </td>
                                <td>
                                    {{ $item->golongan->nama_golongan }} - {{ $item->golongan->deskripsi }}
                                </td>
                                <td>
                                    {{ $item->no_hp }}
                                </td>
                                <td>{{ $item->jabatan_struktural->nama_jabatan ?? '-' }}</td>
                                <td>{{ $item->jabatan_fungsional->nama_jabatan ?? '-' }}</td>
                                <td>
                                    <center>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEditPegawai{{ $item->id }}">
                                            <i class="nav-icon fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('pegawai.destroy', $item->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="nav-icon fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </center>
                                </td>
                            </tr>
                            <!-- Modal Edit Pegawai -->
                            <div class="modal fade" id="modalEditPegawai{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modalEditPegawaiLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <form action="{{ route('pegawai.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditPegawaiLabel">Edit Pegawai</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
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
                                                                value="{{ $item->nama_lengkap }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nip">NIP</label>
                                                            <input type="text" name="nip" class="form-control"
                                                                value="{{ $item->nip }}"
                                                                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nik">NIK</label>
                                                            <input type="text" name="nik" class="form-control"
                                                                value="{{ $item->nik }}"
                                                                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="golongan_id">Golongan</label>
                                                            <select name="golongan_id" class="form-control" required>
                                                                <option value="">-- Pilih Golongan --</option>
                                                                @foreach ($golongan as $g)
                                                                    <option value="{{ $g->id }}"
                                                                        {{ $item->golongan_id == $g->id ? 'selected' : '' }}>
                                                                        {{ $g->nama_golongan }} - {{ $g->deskripsi }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Kolom 2 -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" name="email" class="form-control"
                                                                value="{{ $item->email }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="no_hp">No HP</label>
                                                            <input type="text" name="no_hp" class="form-control"
                                                                value="{{ $item->no_hp }}"
                                                                oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jabatan_struktural_id">Jabatan Struktural</label>
                                                            <select name="jabatan_struktural_id" class="form-control">
                                                                <option value="">-- Pilih Jabatan Struktural --
                                                                </option>
                                                                @foreach ($jabatan_struktural as $js)
                                                                    <option value="{{ $js->id }}"
                                                                        {{ $item->jabatan_struktural_id == $js->id ? 'selected' : '' }}>
                                                                        {{ $js->nama_jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jabatan_fungsional_id">Jabatan Fungsional</label>
                                                            <select name="jabatan_fungsional_id" class="form-control">
                                                                <option value="">-- Pilih Jabatan Fungsional --
                                                                </option>
                                                                @foreach ($jabatan_fungsional as $jf)
                                                                    <option value="{{ $jf->id }}"
                                                                        {{ $item->jabatan_fungsional_id == $jf->id ? 'selected' : '' }}>
                                                                        {{ $jf->nama_jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="alamat">Alamat</label>
                                                        <textarea name="alamat" class="form-control" cols="100" rows="3" required>{{ $item->alamat }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </table>
                    <br>
                    <div class="d-flex">
                        {!! $pegawai->links('pagination::bootstrap-4') !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Pegawai -->
    <div class="modal fade" id="modalTambahPegawai" tabindex="-1" role="dialog"
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
                                    <label for="jabatan_struktural_id">Jabatan Struktural</label>
                                    <select name="jabatan_struktural_id" class="form-control">
                                        <option value="">-- Pilih Jabatan Struktural --</option>
                                        @foreach ($jabatan_struktural as $js)
                                            <option value="{{ $js->id }}">{{ $js->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan_fungsional_id">Jabatan Fungsional</label>
                                    <select name="jabatan_fungsional_id" class="form-control">
                                        <option value="">-- Pilih Jabatan Fungsional --</option>
                                        @foreach ($jabatan_fungsional as $jf)
                                            <option value="{{ $jf->id }}">{{ $jf->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control" cols="100" rows="3" placeholder="Masukkan Alamat Pegawai"
                                    required></textarea>
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
