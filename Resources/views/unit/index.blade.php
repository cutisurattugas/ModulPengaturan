@extends('adminlte::page')
@section('title', 'Unit')
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Unit</h1>
                    <div class="lead">
                        Manaje Unit.
                        <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#modalTambahUnit">Tambah Unit</a>

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
                            <th colspan="2">
                                <center>Opsi</center>
                            </th>
                        </tr>
                        @foreach ($units as $item)
                            <tr>
                                <td>
                                    <center>{{ $loop->iteration }}</center>
                                </td>
                                <td>
                                    {{ $item->nama }}
                                </td>
                                <td>
                                    <center>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEditUnit{{ $item->id }}">
                                            <i class="nav-icon fas fa-edit"></i>
                                        </a>

                                        <form action="{{route('unit.destroy', $item->id)}}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="nav-icon fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </center>
                                </td>
                            </tr>
                            <!-- Modal Edit Unit -->
                            <div class="modal fade" id="modalEditUnit{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modalEditUnitLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('unit.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditUnitLabel{{ $item->id }}">Edit Unit
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="nama">Nama Unit</label>
                                                    <input type="text" name="nama" class="form-control"
                                                        value="{{ $item->nama }}" required>
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

                    <div class="d-flex">
                        {!! $units->links('pagination::bootstrap-4') !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tambah Unit -->
    <div class="modal fade" id="modalTambahUnit" tabindex="-1" role="dialog" aria-labelledby="modalTambahUnitLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('unit.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahUnitLabel">Tambah Unit Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama">Nama Unit</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Unit"
                                required>
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
