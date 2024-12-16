<style>
    .table {
            background-color: #fff; /* Set table background to white */
        }
        .btn-status-success {
            background-color: #28a745;
            color: #fff;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 1rem;
            display: inline-block;
        }
        .btn-status-danger {
            background-color: #dc3545;
            color: #fff;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 1rem;
            display: inline-block;
        }
        .btn-status-warning {
            background-color: #ffc107;
            color: #212529;
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 1rem;
            display: inline-block;
        }
</style>
@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection
@section('content')
     <div class="container-fluid py-5" style="font-size: 11px;">
        <h6 class="font-weight-bold text-primary mb-4" style="font-size: 11px;">List Status Validasi Persyaratan Lomba</h6>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 11px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pembina</th>
                        <th>Pangkalan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($finalisasis as $index => $finalisasi)
                        @php
                        $status = $finalisasi->status;
                        $statusDokumenLabel = $status === 1 ? 'btn-status-success': ($status === 0 ? 'btn-status-danger' : 'btn-status-warning');
                        $statusDokumenText = $status === 1 ? 'Tervalidasi' : ($status === 0 ? 'Tidak Tervalidasi' : 'Menunggu Verifikasi');
                        @endphp
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$finalisasi->pembina->nama}}</td>
                            <td>{{$finalisasi->pembina->pangkalan}}</td>
                            <td>
                                <span class="{{$statusDokumenLabel}}" style="font-size: 11px;">{{$statusDokumenText}}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-center">
                            <i class="fas fa-info-circle text-warning"></i> <strong>Pemberitahuan:</strong> Data Pangkalan yang belum lolos validasi tolong mengecek kelengkapan registrasi lomba oleh Pembina masing-masing.
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
