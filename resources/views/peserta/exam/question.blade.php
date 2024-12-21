
<link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    .form-check-label::before {
        content: attr(data-option);
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 1px solid #ced4da;
        border-radius: 50%;
        text-align: center;
        line-height: 20px;
        margin-right: 10px;
        color: #6c757d;
    }
    .form-check-input {
        display: none;
    }
    .form-check-input:checked + .form-check-label::before {
        background-color: #6c757d;
        color: white;
    }
    .btn-outline-secondary {
        background-color: #6c757d;
        color: white;
    }
    .btn-outline-secondary:hover {
        background-color: #5a6268;
        color: white;
    }
</style>
@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection

@section('content')
<p style="text-align: center;"> 
    <span>NISN : </span>{{ Auth::user()->peserta->nisn }}
    <span style="padding-left:80px;">Nama Peserta : </span>{{ Auth::user()->peserta->nama }} 
    <span style="padding-left:80px;">Nama Regu : </span>{{ Auth::user()->peserta->regu_pembina->nama_regu }}
    <span style="padding-left:80px;">Pangkalan : </span>{{ Auth::user()->peserta->regu_pembina->pembina->pangkalan }}
</p>

<div class="container-fluid d-flex mt-3">
    <!-- Konten Soal -->
    <div class="p-4 border bg-light flex-grow-1 me-4" style="font-size: 11px;">
        <!-- Header Soal -->
        <div class="p-3 border-bottom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 style="font-size: 11px;">Soal No. {{ $currentOrder }}</h5>
                <span>Sisa Waktu: <b id="time-remaining">{{ gmdate('H:i:s', $duration) }}</b></span>
            </div>
        </div>

        <form id="question-form" method="POST">
            @csrf
            <!-- Teks Soal -->
            <h5 style="font-size: 11px; padding:20px;">{{ $question->question }}</h5>

            <!-- Pilihan Jawaban -->
            <div class="options">
                @foreach (['a', 'b', 'c', 'd', 'e'] as $option)
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="radio" name="answer" value="{{ $option }}" id="option_{{ $option }}" {{ $selectedAnswer == $option ? 'checked' : '' }} required>
                        <label class="form-check-label" for="option_{{ $option }}" data-option="{{ strtoupper($option) }}">
                            {{ $question->{'answer_' . $option} }}
                        </label>
                    </div>
                @endforeach
            </div>
        </form>

        <!-- Navigasi Soal Sebelumnya & Selanjutnya -->
        <div class="d-flex justify-content-between mt-4">
            @if ($currentOrder > 1)
                <a href="{{ route('peserta.exam.question', ['exam_id' => $exam->id, 'order' => $currentOrder - 1]) }}" class="btn btn-secondary" style="font-size: 11px;">
                    &larr; Soal Sebelumnya
                </a>
            @endif
            @if ($currentOrder < $totalQuestions)
                <a href="{{ route('peserta.exam.question', ['exam_id' => $exam->id, 'order' => $currentOrder + 1]) }}" class="btn btn-primary" style="font-size: 11px;">
                    Soal Selanjutnya &rarr;
                </a>
            @endif
        </div>
    </div>

    <!-- Navigasi Nomor Soal -->
    <div class="p-4 border bg-light" style="width: 280px; font-size:11px;">
        <h6 style="font-size: 11px;">Navigasi Soal</h6>
        <div class="d-grid gap-2" style="grid-template-columns: repeat(5, 1fr);">
            @for ($i = 1; $i <= $totalQuestions; $i++)
                <a href="{{ route('peserta.exam.question', ['exam_id' => $exam->id, 'order' => $i]) }}"
                   class="btn {{ isset($answers[$i]) ? 'btn-success text-white' : 'btn-outline-secondary' }} "
                   style="font-size: 11px;">
                    {{ $i }}
                </a>
            @endfor
        </div>
        <button class="btn btn-danger mt-3" style="width: 100%; font-size:11px;">Akhiri Ujian</button>
        <div class="mt-3 text-warning">{{ count($answers) }} dikerjakan</div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/color-modes.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const duration = {{ $duration }};
        let timer = duration, hours, minutes, seconds;
        const countdownElement = document.getElementById('time-remaining');

        setInterval(() => {
            hours = Math.floor(timer / 3600);
            minutes = Math.floor((timer % 3600) / 60);
            seconds = Math.floor(timer % 60);

            hours = hours < 10 ? '0' + hours : hours;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            countdownElement.textContent = hours + ':' + minutes + ':' + seconds;

            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);

        // Handle answer selection with Ajax
        document.querySelectorAll('.form-check-input').forEach(input => {
            input.addEventListener('change', (event) => {
                const selectedAnswer = event.target.value;
                const questionId = {{ $question->id }};
                const examId = {{ $exam->id }};
                const csrfToken = document.querySelector('input[name="_token"]').value;

                // Ajax request to save the answer
                $.ajax({
                    url: `{{ route('peserta.exam.answer', ['exam_id' => $exam->id, 'order' => $currentOrder]) }}`,
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        answer: selectedAnswer
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('Jawaban tersimpan');
                            // Update button navigation color to green if answer is saved
                            $(`a[href='{{ route('peserta.exam.question', ['exam_id' => $exam->id, 'order' => $currentOrder]) }}']`)
                                .addClass('btn-success');
                        } else {
                            console.error('Error menyimpan jawaban');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    });
</script>
@endsection


