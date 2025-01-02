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
                    <div id="question">
                        <p><strong>{{ $tpk_question->question_text }}</strong></p>
                        @if($tpk_question->question_image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($tpk_question->question_image) }}" alt="Question Image" class="img-fluid">
                        </div>
                        @endif
                        <div class="form-group">
                            @foreach(['a', 'b', 'c', 'd'] as $option)
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="answer_{{ $option }}" name="answer" class="custom-control-input"
                                    value="{{ $option }}" {{ $answer == $option ? 'checked' : '' }}>
                                <label class="custom-control-label d-flex align-items-center" for="answer_{{ $option }}">
                                    <span class="mr-2 font-weight-bold">{{ strtoupper($option) }}.</span>
                                    <span>{{ $tpk_question->{'answer_' . $option} }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
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
                        @php
                        $tpk_questions = $session->tpk_questions;
                        @endphp
                        @foreach ($tpk_questions as $question)
                        @php
                        $answered = \App\Models\TpkAnswer::where('peserta_id', Auth::user()->peserta->id)
                            ->where('cbt_session_id', $session->id)
                            ->where('tpk_question_id', $question->id)
                            ->exists();
                        @endphp
                        <a href="{{ route('start.cbt', ['session_id' => $session->id, 'question_number' => $loop->iteration]) }}"
                            class="btn btn-question {{ $answered ? 'answered' : 'not-answered' }}"
                            id="btn-question-{{ $question->id }}">
                            {{ $loop->iteration }}
                        </a>
                        @endforeach
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
        gap: 25px;
    }

    .number-navigation .btn-question {
        width: 50px;
        height: 50px;
        text-align: center;
        font-weight: bold;
        line-height: 50px;
        border-radius: 0;
    }

    .not-answered {
        background-color: #ffffff;
        color: black;
        border: 1px solid #ddd;
    }

    .answered {
        background-color: #28a745;
        color: white;
        border: 1px solid #28a745;
    }

    @media (max-width: 576px) {
        .number-navigation .btn-question {
            width: 40px;
            height: 40px;
            line-height: 40px;
            font-size: 12px;
        }
    }

    .card {
        border-radius: 0;
    }

    #question {
        padding: 20px;
        background-color: #f8f9fa;
    }

    #question p {
        font-size: 18px;
        line-height: 1.5;
    }

    #question .form-group {
        margin-top: 15px;
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

        $.ajax({
            url: "{{ route('answer.cbt', ['session_id' => $session->id, 'question_number' => $question_number]) }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                answer: selectedAnswer,
                question_id: questionId
            },
            success: function(response) {
                console.log('Response:', response);
                $(`#btn-question-${questionId}`).addClass('answered').removeClass('not-answered');
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
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
