@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert"> {{ session('error') }} </div>
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
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
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
                        @foreach($pesertas as $index => $peserta)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $peserta->nama }}</td>
                                <td>{{ $peserta->regu_pembina->nama_regu }}</td>
                                <td>{{ $peserta->regu_pembina->pembina->pangkalan }}</td>
                                <td>{{ $peserta->jenis_kelamin }}</td>
                                <td>{{ $peserta->penilaian_karikatur->total_nilai }}</td>
                                <td></td>
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
            $('#dataTable').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
            });
        });
    </script>
@endsection
