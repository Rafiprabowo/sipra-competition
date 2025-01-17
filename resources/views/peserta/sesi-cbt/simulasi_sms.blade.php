<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulasi CBT SMS</title>
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
                        <p>Silakan ketikkan huruf yang tepat untuk setiap simbol yang muncul.</p>
                        <div id="question" style="justify-content: center; align-items: center;">
                            <div id="symbols" class="d-flex flex-wrap justify-content-start">
                                @foreach($sms_question->images as $index => $image)
                                    <div class="mb-3 text-center" style="flex: 0 1 100px; margin-right: 2rem;">
                                        <img src="{{ Storage::url($image->symbol->image) }}" alt="Symbol Image" class="img-fluid">
                                        <!-- Input field for each symbol -->
                                        <div class="mt-2">
                                            <input type="text" class="form-control letter-guess" id="letter-guess-{{ $index }}" maxlength="1" data-question-image-id="{{ $image->id }}"
                                                value="{{ isset($saved_answers[$image->id]) ? $saved_answers[$image->id] : '' }}">
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
            <div class="col-md-4" style="margin-top: 100px;">
                <div class="card" style="background-color: #ffffff; border-radius: 0; border: 1px solid #ddd; height:395px;">
                    <div class="card-header">
                        <h5>Nomor Soal</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Pilih nomor soal untuk navigasi</strong></p>
                        <div class="number-navigation">
                            @foreach($sms_questions as $question)
                                <a href="{{ route('simulasi.start', ['nomor_soal' => $loop->iteration]) }}"
                                    class="btn btn-question"
                                    id="btn-question-{{ $question->id }}"
                                    style="background-color: {{ $questionStatus[$question->id] }};">
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
            if (parseInt("{{ $nomor_soal }}") >= "{{ $sms_questions->count() }}") {
                $('#next-question').attr('disabled', true);
            }

            // Save answer when input value changes
            $('.letter-guess').on('input', function() {
                let questionImageId = $(this).data('question-image-id');
                let answer = $(this).val();
                let sms_question_id = "{{ $sms_question->id }}";
                let nama = "{{$nama}}"; // Adjust according to the field you want to save
                console.log(nama);

                $.ajax({
                    url: "{{ route('simulasi.answer.save') }}", // Adjust this route
                    method: 'POST',
                    data: {
                        simulasi_sms_question_image_id: questionImageId,
                        sms_question_id: sms_question_id,
                        answer: answer,
                        nama: nama,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log('Jawaban berhasil disimpan.');
                    },
                    error: function(xhr) {
                        console.error('Gagal menyimpan jawaban:', xhr);
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
                window.location.href = "/simulasi/" + nextQuestionNumber + "?nama=" + nama;
            });

            // Navigate to the previous question
            $('#prev-question').click(function() {
                let prevQuestionNumber = parseInt("{{ $nomor_soal }}") - 1;
                if (prevQuestionNumber > 0) {
                    window.location.href = "/simulasi/" + prevQuestionNumber + "?nama=" + nama;
                }
            });

            // End the test
            $('#end-test').click(function() {
                if (confirm('Apakah Anda yakin ingin mengakhiri tes?')) {
                    window.location.href = "{{ route('simulasi.end', ['nama' => $nama]) }}";
                }
                });
                
        });
    </script>
</body>
</html>
