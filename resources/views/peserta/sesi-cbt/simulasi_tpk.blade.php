<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi CBT TPK</title>
        <!-- Custom fonts for this template-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
    
        <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    
        <!-- Impor CSS DataTables -->
        <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    
        <!-- Custom styles for this template -->
        <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
        <style>
            .number-navigation {
                display: flex;
                flex-wrap: wrap;
                justify-content: start;
                gap: 10px;
            }
        
            .number-navigation .btn-question {
                width: 50px;
                text-align: center;
                font-weight: bold;
                border-radius: 10px;
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
</head>
<body>
    <div class="container-fluid d-flex justify-content-center" style="font-size: 11px;">
        <div class="row w-100">
            <!-- Question Content -->
            <div class="col-md-8" style="margin-top: 100px;">
                <div class="card mb-4" style="background-color: #ffffff; border-radius: 0; border: 1px solid #ddd;">
                    <div class="card-header d-flex justify-content-between align-items-center" style="font-size: 16px;">
                        <span>Soal Nomor {{ $nomor_soal }}</span>
                        <p>{{$nama}}</p>
                    </div>
                    <div class="card-body">
                        <p><strong>{{ $tpk_question->question_text }}</strong></p>
                        @if($tpk_question->question_image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($tpk_question->question_image) }}" alt="{{ $tpk_question->question_text }}" class="img-fluid" width="100">
                        </div>
                        @endif
                        <div class="form-group">
                            @foreach(['a', 'b', 'c', 'd'] as $option)
                            <div class="custom-control custom-radio mb-3">
                                <input type="radio" id="answer_{{ $option }}" name="answer" class="custom-control-input answer"
                                    value="{{ $option }}" {{ $saved_answers == $option ? 'checked' : '' }}>
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
            <div class="col-md-4" style="margin-top: 100px;">
                <div class="card" style="background-color: #ffffff; border-radius: 0; border: 1px solid #ddd; height:395px;">
                    <div class="card-header">
                        <h5>Nomor Soal</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Pilih nomor soal untuk navigasi</strong></p>
                        <div class="number-navigation d-flex flex-wrap justify-content-start">
                            @foreach ($tpk_questions as $question)
                            @php
                            $answered = \App\Models\SimulasiTpkAnswer::where('nama', $nama)
                                ->where('simulasi_tpk_question_id', $question->id)
                                ->exists();
                            @endphp
                            <a href="{{ route('simulasi_tpk.start', ['nomor_soal' => $loop->iteration]) }}"
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

<!-- jQuery -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Bundle (termasuk Popper.js) -->
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- SB Admin 2 (menggunakan Bootstrap) -->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Disable the previous button if the current question number is 1
            if (parseInt("{{ $nomor_soal }}") <= 1) {
                $('#prev-question').attr('disabled', true);
            }

            // Disable the next button if the current question number is the last question
            if (parseInt("{{ $nomor_soal }}") >= "{{ $tpk_questions->count() }}") {
                $('#next-question').attr('disabled', true);
            }

            // Save answer when input value changes
            $('input[name="answer"]').change(function() {
                let answer = $(this).val();
                let tpk_question_id = "{{ $tpk_question->id }}";
                let nama = "{{$nama}}"; // Adjust according to the field you want to save
                console.log(nama);

                $.ajax({
                    url: "{{ route('simulasi_tpk.answer.save', ['nomor_soal' => $nomor_soal]) }}", // Adjust this route
                    method: 'POST',
                    data: {
                        tpk_question_id: tpk_question_id,
                        answer: answer,
                        nama: nama,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Response:', response);
                        $(`#btn-question-${tpk_question_id}`).addClass('answered').removeClass('not-answered');
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                    }
                });
            });

            // Ambil nilai query parameter 'nama' dari URL
            function getQueryParameter(name) {
                let urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(name);
            }

            let nama = getQueryParameter('nama');

            // Navigate to the next question
            $('#next-question').click(function() {
                let nextQuestionNumber = parseInt("{{ $nomor_soal }}") + 1;
                window.location.href = "/simulasi_tpk/" + nextQuestionNumber + "?nama=" + nama;
            });

            // Navigate to the previous question
            $('#prev-question').click(function() {
                let prevQuestionNumber = parseInt("{{ $nomor_soal }}") - 1;
                if (prevQuestionNumber > 0) {
                    window.location.href = "/simulasi_tpk/" + prevQuestionNumber + "?nama=" + nama;
                }
            });

            // End the test
            $('#end-test').click(function() {
                if (confirm('Apakah Anda yakin ingin mengakhiri tes?')) {
                    window.location.href = "{{ route('simulasi_tpk.end', ['nama' => $nama]) }}";
                }
                });
                
        });
    </script>
</body>
</html>
