@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2" style="font-size: 11px;">
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                <p>{{ session('error') }}</p>
                <button onclick="window.location='{{ route('admin.dashboard') }}'" class="btn btn-primary">OK</button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 16px;">Lihat Hasil Penilaian Duta Logika</h6>
                <!-- Tombol Ekspor -->
                <div>
                    <a href="{{ route('exportPDFDutaLogika') }}" class="btn btn-danger btn-md" title="Export PDF" style="font-size: 11px;">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                    <a href="{{ route('exportExcelDutaLogika') }}" class="btn btn-success btn-md" title="Export Excel" style="font-size: 11px;">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTablePeserta" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Regu</th>
                                <th>Pangkalan</th>
                                <th>Jenis Kelamin</th>
                                <th>Nilai akhir</th>
                                <th>Rangking</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peserta as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->regu_pembina->nama_regu }}</td>
                                    <td>{{ $item->regu_pembina->pembina->pangkalan }}</td>
                                    <td>{{ $item->jenis_kelamin }}</td>
                                    <td>{{ $item->highest_total_nilai }}</td>
                                    <td>{{ $item->penilaian_duta_logika->rangking }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTablePeserta').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection
