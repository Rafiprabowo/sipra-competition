<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="{{asset('assets/js/color-modes.js')}}"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Tes Pengetahuan Kepramukaan</title>

    <link href="{{asset('assets/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <style>
        body {
            padding-top: 56px;
        }
    </style>
</head>
<body class="bg-body-tertiary">

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Tes Pengetahuan Kepramukaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">{{auth()->user()->username}}</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <!-- Header Soal -->
    <div class="p-3 border bg-light">
        <div class="d-flex justify-content-between align-items-center">
            <h5>Soal No. {{ $currentOrder }}</h5>
            <span>Sisa Waktu: <b id="time-remaining">01:13:23</b></span>
        </div>
    </div>

    <!-- Konten Soal -->
    <div class="p-4 border border-top-0">
        <form action="{{ route('peserta.exam.answer', ['exam_id' => $exam->id, 'order' => $currentOrder]) }}" method="POST">
            @csrf
            <!-- Teks Soal -->
            <h5>{{ $question->question }}</h5>

            <!-- Pilihan Jawaban -->
            @foreach (['a', 'b', 'c', 'd', 'e'] as $option)
                <div class="form-check mt-2">
                    <input class="form-check-input" type="radio" name="answer" value="{{ $option }}" id="option_{{ $option }}" required>
                    <label class="form-check-label" for="option_{{ $option }}">
                        {{ $question->{'answer_' . $option} }}
                    </label>
                </div>
            @endforeach

            <!-- Navigasi Soal Sebelumnya & Selanjutnya -->
            <div class="d-flex justify-content-between mt-4">
                @if ($currentOrder > 1)
                    <a href="{{ route('peserta.exam.question', ['exam_id' => $exam->id, 'order' => $currentOrder - 1]) }}" class="btn btn-secondary">
                        &larr; Soal Sebelumnya
                    </a>
                @endif
                <button type="submit" class="btn btn-primary">
                    Soal Selanjutnya &rarr;
                </button>
            </div>
        </form>
    </div>

    <!-- Navigasi Nomor Soal -->
    <div class="mt-4">
        <h6>Navigasi Soal</h6>
        <div class="d-flex flex-wrap">
            @for ($i = 1; $i <= $totalQuestions; $i++)
                <a href="{{ route('peserta.exam.question', ['exam_id' => $exam->id, 'order' => $i]) }}"
                   class="m-1 text-center btn
                   {{ $i == $currentOrder ? 'btn-primary text-white' : 'btn-outline-secondary' }}"
                   style="width: 60px; height: 60px; line-height: 45px; font-size: 16px;">
                    {{ $i }}
                </a>
            @endfor
        </div>
    </div>
</main>




<script src="{{asset('assets/dist/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
