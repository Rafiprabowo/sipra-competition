<style>
        body {
            background-color: #f8f9fa;
            color: #333;
        }
        .breadcrumb-item a {
            color: #007bff;
            text-decoration: none;
        }
        .breadcrumb-item a:hover {
            text-decoration: underline;
        }
        h2 {
            color: #007bff;
            margin-bottom: 2rem;
        }
        .card {
            border: none;
            transition: transform 0.2s, box-shadow 0.2s;
            margin-bottom: 1rem;  /* Add space between the cards */
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            color: #007bff;
        }
        .card-img-top {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
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
    @include('layouts.sidebar.peserta')
@endsection
@section('content')
    <div class="container-fluid " style="font-size: 11px;">
          <nav class="mb-4" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item {{ request('tab') == null ? 'active' : '' }}" {{ request('tab') == null ? 'aria-current=page' : '' }}>
                        <a href="{{ route('peserta.dashboard') }}" class="text-decoration-none {{ request('tab') == null ? 'active' : '' }}">Mata Lomba</a>
                    </li>
                    <li class="breadcrumb-item {{ request('tab') == 'listverifikasi' ? 'active' : '' }}" {{ request('tab') == 'listverifikasi' ? 'aria-current=page' : '' }}>
                        <a href="{{ route('peserta.dashboard', ['tab' => 'listverifikasi']) }}" class="text-decoration-none {{ request('tab') == 'listverifikasi' ? 'active' : '' }}" id="loadListVerifikasi">
                            List Verifikasi Pangkalan
                        </a>
                    </li>
                </ol>
            </nav>

       @if(isset($finalisasis))
            <div class="container-fluid py-5" style="font-size: 11px;">
        <h6 class="font-weight-bold text-primary mb-4" style="font-size: 11px;">List Status Validasi Persyaratan Lomba</h6>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 11px; text-align:center;">
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
       @else
        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-6 col-sm-6 col-lg-4 p-4">
                <div class="card shadow-sm rounded-4 h-100 text-center">
                    <img src="{{ asset('img/iot.jpg') }}" class="card-img-top img-fluid p-3" alt="Internet of Things">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="font-size: 11px;">Pioneering</h5>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-6 col-sm-6 col-lg-4 p-4">
                <div class="card shadow-sm rounded-4 h-100 text-center">
                    <img src="{{ asset('img/bistik.jpg') }}" class="card-img-top img-fluid p-3" alt="Perencanaan Bisnis">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="font-size: 11px;">Karikatur</h5>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-6 col-sm-6 col-lg-4 p-4">
                <div class="card shadow-sm rounded-4 h-100 text-center">
                    <img src="{{ asset('img/hackathon.jpg') }}" class="card-img-top img-fluid p-3" alt="Hackathon">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="font-size: 11px;">Duta Logika</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Card 5 -->
            <div class="col-md-6 col-sm-6 col-lg-4 p-4">
                <div class="card shadow-sm rounded-4 h-100 text-center">
                    <img src="{{ asset('img/game.jpg') }}" class="card-img-top img-fluid p-3" alt="Pengembangan Game">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="font-size: 11px;">Semaphore Morse</h5>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col-md-6 col-sm-6 col-lg-4 p-4">
                <div class="card shadow-sm rounded-4 h-100 text-center">
                    <img src="{{ asset('img/egov.jpg') }}" class="card-img-top img-fluid p-3" alt="E-Government">
                    <div class="card-body">
                        <h5 class="card-title fw-bold" style="font-size: 11px;">LKFBB</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-4 p-4">
                <div class="card shadow-sm rounded-4 h-100 text-center">
                    <a href="{{route('peserta.sesi-tpk.index')}}" class="text-center text-lg text-decoration-none" >
                        <img src="{{asset('img/egov.jpg')}}" alt="Tes Pengetahuan Kepramukaan" class="card-img-top img-fluid p-3">
                        <span class="card-title" style="font-size: 11px;">Tes Pengetahuan Kepramukaan</span>
                    </a>
                </div>
            </div>
        </div>
       @endif
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTable').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection

