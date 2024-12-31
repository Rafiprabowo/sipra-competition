@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection
@section('content')
    <div class="container-fluid d-flex justify-content-center">
        <div class="row w-100">
            <!-- Question Content -->
            <div class="col-md-8">
                <div class="card mb-4" style="background-color: #ffffff; border-radius: 0; border: 1px solid #ddd;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Soal Nomor {{ $question_number }}</span>
                        <span>{{ $session->nama }}</span>
                    </div>
                    <div class="card-body">
                        @if($tpk_question->question_image)
                            <div class="mb-3">
                                <img src="{{ Storage::url($tpk_question->question_image) }}" alt="Question Image" class="img-fluid">
                            </div>
                        @endif
                        <p><strong>{{ $tpk_question->question_text }}</strong></p>
                        <div class="form-group">
                            @foreach(['a', 'b', 'c', 'd'] as $option)
                                <div class="custom-control custom-radio mb-3">
                                    <input type="radio" id="answer_{{ $option }}" name="answer" class="custom-control-input" value="{{ $option }}" {{ $answer == $option ? 'checked' : '' }}>
                                    <label class="custom-control-label d-flex align-items-center" for="answer_{{ $option }}">
                                        <span class="mr-2 font-weight-bold">{{ strtoupper($option) }}.</span>
                                        <span>{{ $tpk_question->{'answer_' . $option} }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button id="prev-question" class="btn btn-secondary">Soal Sebelumnya</button>
                        <button id="next-question" class="btn btn-primary">Soal Selanjutnya</button>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Content -->
            <div class="col-md-4">
                <div class="card" style="background-color: #ffffff; border-radius: 0; border: 1px solid #ddd;">
                    <div class="card-header">
                        <h5>Nomor Soal</h5>
                    </div>
                    <div class="card-body">
                        <div class="number-navigation d-flex flex-wrap justify-content-start">
                            @for ($i = 1; $i <= $total_questions; $i++)
                                @php
                                    $answered = \App\Models\TpkAnswer::where('peserta_id', Auth::user()->peserta->id)
                                        ->where('cbt_session_id', $session->id)
                                        ->where('tpk_question_id', $i)
                                        ->exists();
                                @endphp
                                <a href="{{ route('start.cbt', ['session_id' => $session->id, 'question_number' => $i]) }}" 
                                    class="btn btn-question {{ $answered ? 'answered' : 'not-answered' }}" 
                                    id="btn-question-{{ $i }}">
                                     {{ $i }}
                                 </a>
                                 
                            @endfor
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button id="end-test" class="btn btn-danger">Akhiri Tes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('h-script')
<style>
    .number-navigation {
        display: flex;
        flex-wrap: wrap;
        justify-content: start;
        gap: 10px; /* Tambahkan jarak antar tombol */
    }

    .number-navigation .btn-question {
        width: 50px;         /* Lebar tombol */
        height: 50px;        /* Tinggi tombol */
        margin: 0;           /* Hapus margin karena digantikan oleh gap */
        text-align: center;  /* Pusatkan teks secara horizontal */
        font-weight: bold;   /* Teks tebal */
        line-height: 50px;   /* Pusatkan teks secara vertikal */
        border-radius: 0;    /* Ujung tombol lancip */
        background-color: #f8f9fa; /* Warna default putih */
        color: black;
        border: 1px solid #ddd;
    }

    .not-answered {
        background-color: #ffffff; /* Warna putih untuk tombol default */
        color: black;
        border: 1px solid #ddd;
    }

    .answered {
        background-color: #28a745; /* Warna hijau untuk soal yang telah dijawab */
        color: white;
        border: 1px solid #28a745;
    }

    @media (max-width: 576px) {
        .number-navigation .btn-question {
            width: 40px;       /* Lebar tombol lebih kecil */
            height: 40px;      /* Tinggi tombol lebih kecil */
            line-height: 40px; /* Sesuaikan tinggi teks */
            font-size: 12px;   /* Ukuran font lebih kecil */
        }
    }

    .card {
        border-radius: 0; /* Buat ujung card lancip */
    }
</style>
@endsection

@section('script')
<script>
$(document).ready(function() {
    $('input[name="answer"]').change(function() {
    let selectedAnswer = $(this).val();
    let sessionId = "{{ $session->id }}";
    let questionId = "{{ $tpk_question->id }}";

    console.log('Answer:', selectedAnswer);
    console.log('Session ID:', sessionId);
    console.log('Question ID:', questionId);

    $.ajax({
        url: "{{ route('answer.cbt', ['session_id' => $session->id, 'question_number' => $question_number]) }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            answer: selectedAnswer,
            question_id: questionId
        },
        success: function(response) {
            console.log(response.message);
            $(`#btn-question-{{ $question_number }}`).addClass('answered').removeClass('not-answered');
        },
        error: function(xhr) {
            console.log(xhr.responseText);
        }
    });
});


    $('#next-question').click(function() {
        let nextQuestionNumber = parseInt("{{ $question_number }}") + 1;
        window.location.href = "/peserta/cbt/" + "{{ $session->id }}" + "/start/" + nextQuestionNumber;
    });

    $('#prev-question').click(function() {
        let prevQuestionNumber = parseInt("{{ $question_number }}") - 1;
        if (prevQuestionNumber > 0) {
            window.location.href = "/peserta/cbt/" + "{{ $session->id }}" + "/start/" + prevQuestionNumber;
        }
    });

    $('#end-test').click(function() {
        if (confirm('Apakah Anda yakin ingin mengakhiri tes?')) {
            window.location.href = "{{ route('end.cbt', ['session_id' => $session->id]) }}";
        }
    });
});

</script>
@endsection
