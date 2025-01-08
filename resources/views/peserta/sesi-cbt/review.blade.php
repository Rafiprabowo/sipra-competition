@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection
@section('content')
    <div class="container-fluid" style="font-size:11px;">
        <div class="card mb-4 bg-white">
            <div class="card-header">
                <h5>Ulasan Tes CBT</h5>
            </div>
            <div class="card-body">
                <h6>Ringkasan Tes</h6>
                <p><strong>Sesi:</strong> {{ $session->nama }}</p>        
                <p><strong>Waktu Selesai:</strong> {{$completed_at}}</p>
                <hr>
                <p>Terima kasih telah mengikuti tes ini.</p>
                <hr>

                <h6>Langkah Selanjutnya</h6>
                <p>Untuk informasi lebih lanjut atau langkah selanjutnya, kunjungi <a href="{{ route('peserta.dashboard') }}">Dashboard Peserta</a> atau hubungi administrator Anda.</p>
            </div>
        </div>
    </div>
@endsection
