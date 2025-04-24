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
                    </div>

                    <div class="mt-2">
                        @include('layouts.partials.messages')
                    </div>

                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; text-align: center; width: 40px;">No</th>
                                <th class="text-center align-middle">Nama</th>
                                <th class="text-center align-middle">NIP</th>
                                <th class="text-center align-middle">Gelar</th>
                                <th class="text-center align-middle">Jenis Kelamin</th>
                                <th class="text-center align-middle">Username</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $item)
                                <tr>
                                    <td>
                                        <center>{{ $loop->iteration }}</center>
                                    </td>
                                    <td>{{ $item->nama}}</td>
                                    <td>{{ $item->nip}}</td>
                                    <td>
                                        {{ $item->gelar_dpn ?? '' }}{{ $item->gelar_dpn ? ' ' : '' }}{{ $item->nama }}{{ $item->gelar_blk ? ', ' . $item->gelar_blk : '' }}
                                    </td>
                                    <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $item->username ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br>
                    <div class="d-flex">
                        {!! $pegawai->links('pagination::bootstrap-4') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
