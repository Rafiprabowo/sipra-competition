@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger" role="alert">
            <p>{{ session('error') }}</p>
            <button onclick="window.location='{{ route('admin.dashboard') }}'" class="btn btn-primary">OK</button>
        </div>
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

        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Lihat Hasil Penilaian Foto</h6>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="putra-tab" data-toggle="tab" href="#putra" role="tab" aria-controls="putra" aria-selected="true">Foto</a>
                    </li>
                </ul>
                <!-- Tombol Ekspor -->
                <div>
                    <a href="{{ route('exportPDFSemaphore', ['tab' => 'penilaian_semaphore']) }}" class="btn btn-danger btn-md" title="Export PDF" style="font-size: 11px;">
                        <i class="fas fa-file-pdf"></i> Export PDF
                    </a>
                    <a href="{{ route('exportExcelSemaphore') }}" class="btn btn-success btn-md" title="Export Excel" style="font-size: 11px;">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <!-- Foto Tab -->
                    <div class="tab-pane fade show active" id="putra" role="tabpanel" aria-labelledby="putra-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTablePutra" width="100%" cellspacing="0" style="text-align: center;">
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
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk DataTable -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTablePutra').DataTable({
                pageLength: 10,
                responsive: true,
                searching: true,
                ordering: true,
            });
        });
    </script>
@endsection
