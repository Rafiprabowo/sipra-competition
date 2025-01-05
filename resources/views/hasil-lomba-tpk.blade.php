@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        @if($top_peserta->isEmpty())
            <div class="alert alert-info" role="alert">
                Tidak ada data peserta yang tersedia saat ini.
            </div>
        @else
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-end">
                          <!-- Tombol untuk ekspor PDF -->
                        <a href="{{ route('pdf.lomba-tpk') }}" class="btn btn-primary mt-4 mr-2" style="font-size: 11px;">
                            <i class="fas fa-file-pdf"></i> Ekspor PDF
                        </a>
                        <a href="{{ route('excel.lomba-tpk') }}" class="btn btn-primary mt-4" style="font-size: 11px;">
                            <i class="fas fa-file-pdf"></i> Ekspor Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-peserta" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peserta</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nilai</th>
                                    <th>Nama Regu</th>
                                    <th>Nama Pangkalan</th>
                                    <th>Rangking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($top_peserta as $index => $peserta)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $peserta['nama_peserta'] }}</td>
                                        <td>{{ $peserta['jenis_kelamin'] }}</td>
                                        <td>{{ $peserta['score'] }}</td>
                                        <td>{{ $peserta['nama_regu'] }}</td>
                                        <td>{{ $peserta['nama_pangkalan'] }}</td>
                                        <td>{{ $peserta['peringkat'] }}</td> <!-- Menampilkan Peringkat -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-start mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="font-size: 11px;" title="Kembali">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#table-peserta').DataTable();
        });
    </script>
@endsection
