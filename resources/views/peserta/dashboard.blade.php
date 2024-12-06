<style>
    .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

.card-img-top {
    max-height: 150px;
    object-fit: contain;
}

.card-body {
    background-color: #f8f9fa;
    padding: 20px;
    border-top: 2px solid #007bff;
}

.card-title {
    color: #343a40;
}

</style>

@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection
@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">LOMBA</h2>
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <img src="{{ asset('img/iot.jpg') }}" class="card-img-top img-fluid p-3" alt="Internet of Things">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Pioneering</h5>
                </div>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <img src="{{ asset('img/bistik.jpg') }}" class="card-img-top img-fluid p-3" alt="Perencanaan Bisnis">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Karikatur</h5>
                </div>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4 col-sm-6">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <img src="{{ asset('img/hackathon.jpg') }}" class="card-img-top img-fluid p-3" alt="Hackathon">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Duta Logika</h5>
                </div>
            </div>
        </div>
        <!-- Add more cards as needed -->
        <div class="col-md-4 col-sm-6 pt-4">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <img src="{{ asset('img/animasi.jpg') }}" class="card-img-top img-fluid p-3" alt="Animasi">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Tes Kemampuan Kepramukaan</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 pt-4">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <img src="{{ asset('img/game.jpg') }}" class="card-img-top img-fluid p-3" alt="Pengembangan Game">
                <div class="card-body">
                    <h5 class="card-title fw-bold">Semaphore Morse</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 pt-4">
            <div class="card shadow-sm rounded-4 h-100 text-center">
                <img src="{{ asset('img/egov.jpg') }}" class="card-img-top img-fluid p-3" alt="E-Government">
                <div class="card-body">
                    <h5 class="card-title fw-bold">LKFBB</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

