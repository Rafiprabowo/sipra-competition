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
                    <p>Silakan ketikkan huruf yang tepat untuk setiap simbol yang muncul.</p>
                    <div id="question">
                        <div id="symbols" class="d-flex flex-wrap justify-content-start">
                            @foreach($sms_question->images as $index => $image)
                                <div class="mb-3 text-center" style="flex: 0 1 100px; margin-right: 2rem;">
                                    <img src="{{ Storage::url($image->symbol->image) }}" alt="Symbol Image" class="img-fluid">
                                    <!-- Input field for each symbol -->
                                    <div class="mt-2">
                                        <input type="text" class="form-control letter-guess" id="letter-guess-{{ $index }}" maxlength="1" data-question-image-id = "{{$image->id}}" value="{{$answers->where('sms_question_image_id', $image->id)->first()->answer ?? ''}}" >
                                    </div>
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
            <p><strong>Pilih nomor soal untuk navigasi</strong></p>
            <div class="number-navigation">
                @foreach($session->smsQuestions as $number => $question)
                    <a href="/peserta/cbt/{{ $session->id }}/start/{{ $number + 1 }}"
                       class="btn btn-question {{ $number + 1 == $question_number ? 'answered' : 'not-answered' }}">
                        {{ $number + 1 }}
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

    #symbols {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    #symbols .mb-3 {
        margin-right: 10px;
        text-align: center;
    }

    #symbols img {
        width: auto;
        height: 100px; /* Height of images */
    }

    #symbols .letter-guess {
        width: 100px; /* Set the width of the input to match the width of the image */
        margin-top: 5px; /* Space between symbol and input */
        text-align: center; /* Center the text inside the input */
    }

    #question {
        padding: 20px;
        background-color: #f8f9fa;
    }

    #question .form-group {
        margin-top: 15px;
    }

</style>
@endsection

@section('script')
<script>
$(document).ready(function() {
    if (parseInt("{{ $question_number }}") <= 1) {
        $('#prev-question').attr('disabled', true);
    }

    if (parseInt("{{ $question_number }}") >= "{{ $session->smsQuestions->count() }}") {
        $('#next-question').attr('disabled', true);
    }

    $('.letter-guess').on('input', function (){
        let questionImageId = $(this).data('question-image-id');
        let answer = $(this).val()
        let sessionId = "{{$session->id}}"

        console.log('Symbol ID:', questionImageId, 'Answer ID : ', answer, 'Session ID : ', sessionId); // Debugging purpose
        $.ajax({
            url: "{{route('save-sms.answer')}}",
            method: 'POST',
            data: {
                sms_question_image_id: questionImageId,
                answer: answer,
                session_id: sessionId,
                _token: "{{csrf_token()}}" 
            },
            success: function(response){
                console.log('Jawaban berhasil disimpan.');
                console.log(response.data)
            },
            error: function(xhr){
                console.error('Gagal menyimpan jawaban : ', xhr);
            }
        })
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

