@extends('adminlte::page')
@section('title', 'Pejabat')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
@stop
@section('content_header')
    <h1 class="m-0 text-dark"></h1>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h1>Pejabat</h1>
                    <div class="lead">
                        Manaje Pejabat.
                        <a href="#" class="btn btn-primary btn-sm float-right" data-toggle="modal"
                            data-target="#modalTambahPejabat">Tambah Pejabat</a>

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
                                <center>Unit</center>
                            </th>
                            <th>
                                <center>Jabatan</center>
                            </th>
                            <th>
                                <center>Periode</center>
                            </th>
                            <th>
                                <center>Status</center>
                            </th>
                            <th>
                                <center>SK</center>
                            </th>
                            <th colspan="2">
                                <center>Opsi</center>
                            </th>
                        </tr>
                        @foreach ($pejabat as $item)
                            <tr>
                                <td>
                                    <center>{{ $loop->iteration }}</center>
                                </td>
                                <td>
                                    {{ $item->pegawai }}
                                </td>
                                <td>
                                    @if ($item->unit == null)
                                        <p>-</p>
                                    @elseif($item->unit != null)
                                        {{ $item->unit->nama }}
                                    @endif
                                </td>
                                <td>
                                    {{ $item->jabatan->nama_jabatan }}
                                </td>
                                <td>
                                    {{ $item->periode_mulai }} - {{ $item->periode_selesai }}
                                </td>
                                <td>
                                    @if ($item->status == '1')
                                        <button class="btn btn-outline-primary btn-sm">Aktif</button>
                                    @else
                                        <button class="btn btn-outline-danger btn-sm">Non-Aktif</button>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm"
                                        onclick="lihatSK('{{ asset('storage/' . $item->sk) }}')">
                                        Lihat SK
                                    </button>

                                </td>
                                <td>
                                    <center>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEditPejabat{{ $item->id }}">
                                            <i class="nav-icon fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('pejabat.destroy', $item->id) }}" method="POST"
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

                            <!-- Modal SK Pejabat -->
                            <div class="modal fade" id="modalLihatSK" tabindex="-1" role="dialog"
                                aria-labelledby="modalLihatSKLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLihatSKLabel">Lihat SK Pejabat</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Embed PDF SK -->
                                            <iframe id="iframeSK" src="" width="100%" height="500px"
                                                frameborder="0"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Edit Pejabat -->
                            <div class="modal fade" id="modalEditPejabat{{ $item->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modalEditPejabatLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <form action="{{ route('pejabat.update', $item->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditPejabatLabel">Edit Data Pejabat</h5>
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
                                                            <label for="pegawai_id">Pegawai</label>
                                                            <select name="pegawai" id="pegawaiDropdownEdit">
                                                                <option value="">-- Pilih Pegawai --</option>
                                                                @foreach ($pegawai as $p)
                                                                    <option 
                                                                        value="{{ $p->gelar_dpn ?? '' }}{{ $p->gelar_dpn ? ' ' : '' }}{{ $p->nama }}{{ $p->gelar_blk ? ', ' . $p->gelar_blk : '' }}"
                                                                        {{ $item->pegawai == $p->nama ? 'selected' : '' }}>
                                                                        {{ $p->gelar_dpn ?? '' }}{{ $p->gelar_dpn ? ' ' : '' }}{{ $p->nama }}{{ $p->gelar_blk ? ', ' . $p->gelar_blk : '' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nip">NIP</label>
                                                            <input type="text" name="nip"
                                                                class="form-control nipInputedit"
                                                                value="{{ $item->nip }}" readonly required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="periode_mulai">Periode Mulai</label>
                                                            <input type="date" name="periode_mulai" class="form-control"
                                                                value="{{ $item->periode_mulai }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="periode_selesai">Periode Selesai</label>
                                                            <input type="date" name="periode_selesai"
                                                                class="form-control"
                                                                value="{{ $item->periode_selesai }}">
                                                        </div>
                                                    </div>

                                                    <!-- Kolom 2 -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="status">Status</label>
                                                            <select name="status" class="form-control" required>
                                                                <option value="1"
                                                                    {{ $item->status == 1 ? 'selected' : '' }}>Aktif
                                                                </option>
                                                                <option value="0"
                                                                    {{ $item->status == 0 ? 'selected' : '' }}>Non-Aktif
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="unit_id">Unit</label>
                                                            <select name="unit_id" class="form-control" required>
                                                                <option value="" disabled>Pilih Unit</option>
                                                                @foreach ($unit as $u)
                                                                    <option value="{{ $u->id }}"
                                                                        {{ $item->unit_id == $u->id ? 'selected' : '' }}>
                                                                        {{ $u->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="jabatan_id">Jabatan</label>
                                                            <select name="jabatan_id" class="form-control" required>
                                                                <option value="" disabled>Pilih Jabatan</option>
                                                                @foreach ($jabatan as $j)
                                                                    <option value="{{ $j->id }}"
                                                                        {{ $item->jabatan_id == $j->id ? 'selected' : '' }}>
                                                                        {{ $j->nama_jabatan }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="sk">SK (Upload Baru Jika Ingin
                                                                Mengganti)</label>
                                                            <input type="file" name="sk" class="form-control">
                                                            <small class="text-muted">Kosongkan jika tidak ingin mengubah
                                                                SK.</small>
                                                            <br>
                                                            @if ($item->sk)
                                                                <a href="{{ asset('storage/' . $item->sk) }}"
                                                                    target="_blank" class="btn btn-sm btn-primary mt-2">
                                                                    Lihat SK Saat Ini
                                                                </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </table>
                    <br>
                    <div class="d-flex">
                        {!! $pejabat->links('pagination::bootstrap-4') !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Pejabat -->
    <div class="modal fade" id="modalTambahPejabat" tabindex="-1" role="dialog"
        aria-labelledby="modalTambahPejabatLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('pejabat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahPejabatLabel">Tambah Pejabat Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Kolom 1 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pegawai">Pegawai</label>
                                    <select name="pegawai" id="pegawaiDropdown">
                                        <option value="">-- Pilih Pegawai --</option>
                                        @foreach ($pegawai as $item)
                                            <option
                                                value="{{ $item->gelar_dpn ?? '' }}{{ $item->gelar_dpn ? ' ' : '' }}{{ $item->nama }}{{ $item->gelar_blk ? ', ' . $item->gelar_blk : '' }}">
                                                {{ $item->gelar_dpn ?? '' }}{{ $item->gelar_dpn ? ' ' : '' }}{{ $item->nama }}{{ $item->gelar_blk ? ', ' . $item->gelar_blk : '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nip">NIP</label>
                                    <input type="text" name="nip" class="form-control nipInput" value=""
                                        readonly required>
                                </div>
                                <div class="form-group">
                                    <label for="periode_mulai">Periode Mulai</label>
                                    <input type="date" name="periode_mulai" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="periode_selesai">Periode Selesai</label>
                                    <input type="date" name="periode_selesai" class="form-control">
                                </div>
                            </div>

                            <!-- Kolom 2 -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="1">Aktif</option>
                                        <option value="0">Non-Aktif</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="unit_id">Unit</label>
                                    <select name="unit_id" class="form-control">
                                        <option value="" disabled selected>Pilih Unit</option>
                                        @foreach ($unit as $u)
                                            <option value="{{ $u->id }}">{{ $u->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan_id">Jabatan</label>
                                    <select name="jabatan_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih Jabatan</option>
                                        @foreach ($jabatan as $j)
                                            <option value="{{ $j->id }}">{{ $j->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sk">SK</label>
                                    <input type="file" name="sk" class="form-control" required>
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
    </div>
@stop
@section('adminlte_js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    {{-- alert hapus data --}}
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

    {{-- lihat isi sk (pdf) --}}
    <script>
        function lihatSK(fileUrl) {
            document.getElementById('iframeSK').src = fileUrl;
            $('#modalLihatSK').modal('show');
        }
    </script>

    {{-- otomatis isi nip --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pegawaiData = @json($pegawai);

            function setupDropdown(selector, nipInputClass) {
                document.querySelectorAll(selector).forEach(function(dropdown) {
                    // Inisialisasi TomSelect
                    new TomSelect(dropdown, {
                        create: false,
                        sortField: {
                            field: "text",
                            direction: "asc"
                        },
                        placeholder: "-- Pilih Pegawai --"
                    });

                    // Event listener saat dropdown berubah
                    dropdown.addEventListener('change', function() {
                        const selectedNama = this.value;
                        let nipInput = this.closest('.form-group')?.nextElementSibling
                            ?.querySelector('.' + nipInputClass);
                        const selectedPegawai = pegawaiData.find(p => p.nama === selectedNama);

                        if (selectedPegawai && nipInput) {
                            nipInput.value = selectedPegawai.nip;
                        } else if (nipInput) {
                            nipInput.value = '';
                        }
                    });
                });
            }

            // Setup untuk dropdown Add
            setupDropdown('#pegawaiDropdown', 'nipInput');

            // Setup untuk dropdown Edit
            setupDropdown('#pegawaiDropdownEdit', 'nipInputedit');
        });
    </script>
@stop
