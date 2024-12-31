@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="card mb-4 bg-white">
            <div class="card-header">
                <h5>Ulasan Tes CBT</h5>
            </div>
            <div class="card-body">
                <h6>Ringkasan Tes</h6>
                <p><strong>Sesi:</strong> {{ $session->nama }}</p>
                <p><strong>Tanggal:</strong> {{ $session->tanggal }}</p>
                <p><strong>Waktu Mulai:</strong> {{ $session->waktu_mulai }}</p>
                <p><strong>Waktu Selesai:</strong> {{ $session->waktu_selesai }}</p>
                <hr>
                <h6>Feedback</h6>
                <p>Terima kasih telah mengikuti tes ini. Berdasarkan hasil yang Anda peroleh, berikut beberapa saran untuk meningkatkan performa Anda:</p>
                <ul>
                    <li>Perhatikan konsep yang belum dipahami dengan benar.</li>
                    <li>Latih kemampuan mengerjakan soal serupa secara berkala.</li>
                    <li>Baca ulang materi yang berkaitan dengan pertanyaan yang dijawab salah.</li>
                </ul>
                <hr>

                <h6>Langkah Selanjutnya</h6>
                <p>Untuk informasi lebih lanjut atau langkah selanjutnya, kunjungi <a href="{{ route('peserta.dashboard') }}">Dashboard Peserta</a> atau hubungi administrator Anda.</p>
            </div>
        </div>
    </div>
@endsection
