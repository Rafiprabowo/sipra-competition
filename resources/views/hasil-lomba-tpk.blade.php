@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        <h5>Hasil Lomba TPK</h5>

        @if($top_peserta->isEmpty())
            <div class="alert alert-info" role="alert">
                Tidak ada data peserta yang tersedia saat ini.
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-peserta" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Peserta</th>
                                    <th>Regu</th>
                                    <th>Pangkalan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($top_peserta as $peserta)
                                    <tr>
                                        <td>{{ $peserta['nama_peserta'] }}</td>
                                        <td>{{ $peserta['nama_regu'] }}</td>
                                        <td>{{ $peserta['nama_pangkalan'] }}</td>
                                        <td>{{ $peserta['jenis_kelamin']}}</td>
                                        <td>{{ $peserta['score'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-start mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#table-peserta').DataTable();
        });
    </script>
@endsection
