<link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

<style>
    .form-check-input {
        margin-top: 0.3rem;
    }
    .form-check-label {
        margin-bottom: 0;
    }
</style>

@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection

@section('content')
<div class="container-fluid d-flex mt-4">
    <!-- Konten Soal -->
    <div class="p-4 border bg-light flex-grow-1 me-4">
        <!-- Header Soal -->
        <div class="p-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Soal No. {{ $currentOrder }}</h5>
                <span>Sisa Waktu: <b id="time-remaining">01:13:23</b></span>
            </div>
        </div>

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
    <div class="p-4 border bg-light" style="width: 200px;">
        <h6>Navigasi Soal</h6>
        <div class="d-flex flex-column">
            @for ($i = 1; $i <= $totalQuestions; $i++)
                <a href="{{ route('peserta.exam.question', ['exam_id' => $exam->id, 'order' => $i]) }}"
                   class="m-1 text-center btn
                   {{ $i == $currentOrder ? 'btn-primary text-white' : 'btn-outline-secondary' }}"
                   style="width: 100%; height: 60px; line-height: 45px; font-size: 16px;">
                    {{ $i }}
                </a>
            @endfor
        </div>
    </div>
</div>
@endsection

<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/color-modes.js') }}"></script>

