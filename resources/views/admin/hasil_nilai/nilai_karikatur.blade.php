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
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
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
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Lihat Hasil Penilaian Karikatur</h6>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="putra-tab" data-toggle="tab" href="#putra" role="tab" aria-controls="putra" aria-selected="true">Putra</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="putri-tab" data-toggle="tab" href="#putri" role="tab" aria-controls="putri" aria-selected="false">Putri</a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <!-- Putra Tab -->
                    <div class="tab-pane fade show active" id="putra" role="tabpanel" aria-labelledby="putra-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTablePutra" width="100%" cellspacing="0" style="text-align: center;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Regu</th>
                                    <th>Pangkalan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nilai akhir</th>
                                    <th>Rangking</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($putra as $index => $peserta)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $peserta->nama }}</td>
                                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                                        <td>{{ $peserta->jenis_kelamin }}</td>
                                        <td>{{ $peserta->highest_total_nilai }}</td>
                                        <td>{{ $peserta->penilaian_karikatur->rangking }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Putri Tab -->
                    <div class="tab-pane fade" id="putri" role="tabpanel" aria-labelledby="putri-tab">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTablePutri" width="100%" cellspacing="0" style="text-align: center;">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nama Regu</th>
                                    <th>Pangkalan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nilai akhir</th>
                                    <th>Rangking</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($putri as $index => $peserta)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $peserta->nama }}</td>
                                        <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                                        <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                                        <td>{{ $peserta->jenis_kelamin }}</td>
                                        <td>{{ $peserta->highest_total_nilai }}</td>
                                        <td>{{ $peserta->penilaian_karikatur->rangking }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTablePutra').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: false,
            });
            $('#dataTablePutri').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: false,
            });
        });
    </script>
@endsection
