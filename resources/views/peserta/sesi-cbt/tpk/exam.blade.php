@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection
@section('content')
    <div class="container-fluid d-flex justify-content-center">
        <div class="row w-100">
            <!-- Question Content -->
            <div class="col-md-8">
                <div class="card mb-4 bg-white">
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
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="answer_a" name="answer" class="custom-control-input" value="a" {{ $answer == 'a' ? 'checked' : '' }}>
                                <label class="custom-control-label d-flex align-items-center" for="answer_a">
                                    <span class="mr-2 font-weight-bold">A.</span>
                                    <span>{{ $tpk_question->answer_a }}</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="answer_b" name="answer" class="custom-control-input" value="b" {{ $answer == 'b' ? 'checked' : '' }}>
                                <label class="custom-control-label d-flex align-items-center" for="answer_b">
                                    <span class="mr-2 font-weight-bold">B.</span>
                                    <span>{{ $tpk_question->answer_b }}</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="answer_c" name="answer" class="custom-control-input" value="c" {{ $answer == 'c' ? 'checked' : '' }}>
                                <label class="custom-control-label d-flex align-items-center" for="answer_c">
                                    <span class="mr-2 font-weight-bold">C.</span>
                                    <span>{{ $tpk_question->answer_c }}</span>
                                </label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="answer_d" name="answer" class="custom-control-input" value="d" {{ $answer == 'd' ? 'checked' : '' }}>
                                <label class="custom-control-label d-flex align-items-center" for="answer_d">
                                    <span class="mr-2 font-weight-bold">D.</span>
                                    <span>{{ $tpk_question->answer_d }}</span>
                                </label>
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
                <div class="card bg-white">
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
                                <a href="{{ route('start.cbt', ['session_id' => $session->id, 'question_number' => $i]) }}" class="btn m-2 {{ $answered ? 'answered' : 'not-answered' }}" style="width: 45px; height: 45px; color: black; font-weight: bold;">
                                    {{ $i }}
                                </a>
                                @if ($i % 5 == 0) <!-- Break to new row after every 5 items -->
                                    <div class="w-100"></div>
                                @endif
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
    .not-answered {
        background-color: #f0f0f0;
        color: black;
    }
    .answered {
        background-color: #28a745;
        color: white;
    }
</style>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                console.log(response.message);
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

