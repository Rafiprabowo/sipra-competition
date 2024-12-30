@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Soal {{$session->nama}} Computer Based Test </h5>
                <div class="d-flex">
                    <!-- Tombol Import Excel -->
                    <button class="btn btn-success mr-2" data-toggle="modal" data-target="#importModal">
                        <i class="fas fa-file-excel"></i> Import Excel
                    </button>
                    <!-- Tambah Soal -->
                    {{-- <a href="{{ route('sesi-soal.create', ['id' => $session->id, 'nama' => $session->mataLomba->nama]) }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Soal
                    </a> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Pertanyaan</th>
                                <th>Opsi A</th>
                                <th>Opsi B</th>
                                <th>Opsi C</th>
                                <th>Opsi D</th>
                                <th>Kunci Jawaban</th>
                                <th>Tingkat Kesulitan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($session->tpk_questions as $question)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if($question->question_image)
                                            <img src="{{ Storage::url($question->question_image) }}" alt="Question Image" width="50">
                                        @else
                                            -
                                        @endif

                                    </td>
                                    <td>{{$question->question_text}}</td>
                                    <td>{{$question->answer_a}}</td>
                                    <td>{{$question->answer_b}}</td>
                                    <td>{{$question->answer_c}}</td>
                                    <td>{{$question->answer_d}}</td>
                                    <td>{{$question->correct_answer}}</td>
                                    <td>
                                        @if($question->difficulty == 'LOW')
                                            Mudah
                                        @elseif($question->difficulty == 'MIDDLE')
                                            Sulit                            
                                        @endif
                                    </td>
                                    
                                    <td class="d-flex flex-column align-items-center">
                                        <a href="{{route('sesi-soal.edit', ['session_id' => $session->id, 'id' => $question->id, 'nama' => $session->mataLomba->nama])}}" class="btn btn-warning btn-sm mb-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$question->id}}" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('soal-tpk.import', $session->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Soal dari Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih File Excel:</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modals -->
    @foreach($session->tpk_questions as $question)
        <div class="modal fade" id="deleteModal{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$question->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{$question->id}}">Konfirmasi Hapus</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus soal ini?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script>
        $(function(){
            $('#dataTable').DataTable({
                scrollX: true, // Aktifkan scroll horizontal
                autoWidth: false // Nonaktifkan pengaturan otomatis lebar kolom
            });

            $('[data-toggle="tooltip"]').tooltip(); // Initialize tooltips
        });
    </script>
@endsection
