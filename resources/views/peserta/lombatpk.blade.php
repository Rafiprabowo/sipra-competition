<link href="https://cdn.jsdelivr.net/npm/@docsearch/css@3" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgb(255, 255, 255);
        border: solid rgb(255, 255, 255);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgb(255, 255, 255), inset 0 .125em .5em rgb(255, 255, 255);
      }
      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }
      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }
      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }
      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;
        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-black);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }
    </style>
<link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection

@section('content')
<div class="container mt-5">
    <main class="container d-flex justify-content-center align-items-center">
        <div class="col-md-9">
            <div class="border rounded shadow-sm p-4">
                <h3 class="text-center mb-4" style="color: black; font-size:11px;"><b>Informasi Tes</b></h3>
                <table class="table table-bordered" style="font-size: 11px;">
                    <tbody>
                        <tr>
                            <th scope="row" style="color:black; background-color:white;">Nama</th>
                            <td style="color:black; background-color:white;">{{ $exam->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="color:black; background-color:white;">Deskripsi</th>
                            <td style="color:black; background-color:white;">{{ $exam->description ?? 'Tidak ada deskripsi' }}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="color:black; background-color:white;">Durasi</th>
                            <td style="color:black; background-color:white;">{{ $exam->duration ? $exam->duration . ' menit' : 'Tidak ditentukan' }}</td>
                        </tr>
                        {{-- <tr>
                            <th scope="row">Tanggal Dibuat</th>
                            <td>{{ $exam->created_at->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                        </tr> --}}
                    </tbody>
                </table>
                <div class="text-center mt-3">
                    <a href="{{ route('peserta.exam.start', $exam->id) }}" class="btn btn-primary"  style="font-size: 11px;">Mulai Tes</a>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

<script src="{{ asset('assets/js/color-modes.js') }}"></script>
<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

