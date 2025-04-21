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
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['nip'] }}</td>
                                    <td>
                                        {{ $item['gelar_dpn'] ?? '' }}{{ $item['gelar_dpn'] ? ' ' : '' }}{{ $item['nama'] }}{{ $item['gelar_blk'] ? ', ' . $item['gelar_blk'] : '' }}
                                    </td>
                                    <td>{{ $item['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                    <td>{{ $item['username'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <br>
                    {{-- Paginasi --}}
                    @php
                        function getPageNumber($url)
                        {
                            if (!is_string($url) || empty($url)) {
                                return 1;
                            }
                            $parts = parse_url($url);
                            parse_str($parts['query'] ?? '', $query);

                            // Tangani kasus 'page' bisa array atau string
                            if (isset($query['page'])) {
                                return is_array($query['page']) ? $query['page']['number'] ?? 1 : (int) $query['page'];
                            }

                            return 1;
                        }
                    @endphp

                    <div class="pagination">
                        <ul class="pagination">
                            @foreach ($links as $link)
                                @php
                                    $label = is_array($link['label'])
                                        ? implode('', $link['label'])
                                        : (string) $link['label'];
                                    $pageNumber = getPageNumber($link['url']);
                                @endphp

                                @if ($link['url'])
                                    <li class="page-item {{ $link['active'] ? 'active' : '' }}">
                                        <a class="page-link" href="{{ url()->current() . '?page=' . $pageNumber }}">
                                            {!! $label !!}
                                        </a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">{!! $label !!}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
