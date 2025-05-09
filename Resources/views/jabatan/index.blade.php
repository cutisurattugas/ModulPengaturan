@extends('adminlte::page')
@section('title', 'Jabatan')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Jabatan</h1>
                    <div class="lead">
                        Manaje Jabatan.
                        <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#modalTambahJabatan">Tambah Jabatan</a>

                    </div>

                    <div class="mt-2">
                        @include('layouts.partials.messages')
                    </div>

                    <table class="table table-bordered">
                        <tr>
                            <th width="1%">No</th>
                            <th>
                                <center>Nama </center>
                            </th>
                            <th>
                                <center>Role </center>
                            </th>
                            <th colspan="2">
                                <center>Opsi</center>
                            </th>
                        </tr>
                        @foreach ($jabatan as $items)
                            <tr>
                                <td>
                                    <center>{{ $loop->iteration }}</center>
                                </td>
                                <td>
                                    {{ $items->jabatan }}
                                </td>
                                <td>
                                    @if ($items->role == null)
                                        <center><p>-</p></center>
                                    @elseif($items->role != null)
                                        {{$items->role}}
                                    @endif
                                </td>
                                <td>
                                    <center>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEditJabatan{{ $items->id }}">
                                            <i class="nav-icon fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('jabatan.destroy', $items->id) }}" method="POST"
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
                            <!-- Modal Edit Jabatan -->
                            <div class="modal fade" id="modalEditJabatan{{ $items->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modalEditJabatanLabel{{ $items->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('jabatan.update', $items->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditJabatanLabel{{ $items->id }}">Edit
                                                    Jabatan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="nama">Nama Jabatan</label>
                                                    <input type="text" name="jabatan" id="nama" class="form-control"
                                                        value="{{ $items->jabatan }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Role</label>
                                                    <input type="text" class="form-control" id="role" value="{{$items->role}}">
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
                        {!! $jabatan->links('pagination::bootstrap-4') !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Jabatan -->
    <div class="modal fade" id="modalTambahJabatan" tabindex="-1" role="dialog" aria-labelledby="modalTambahJabatanLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('jabatan.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahJabatanLabel">Tambah Jabatan Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Jabatan</label>
                            <input type="text" name="jabatan" class="form-control"
                                placeholder="Masukkan Nama Jabatan" id="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" id="role">
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
