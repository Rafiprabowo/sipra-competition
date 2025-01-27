@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 12px;">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bank Soal Simulasi Tes Pengetahuan Kepramukaan</li>
            </ol>
        </nav>
        
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Bank Soal Simulasi Tes Pengetahuan Kepramukaan</h5>
                <div class="d-flex">
                    <!-- Tombol Import Excel -->
                    <button class="btn btn-warning mr-2" data-toggle="modal" data-target="#importModal" style="font-size: 11px;" title="Import Excel">
                        <i class="fas fa-file-excel"></i>
                    </button>
                 
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Gambar</th>
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
                            @foreach($simulasi_tpk_questions as $question)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$question->question_text}}</td>
                                    <td>
                                        @if($question->question_image)
                                            <img src="{{ Storage::url($question->question_image) }}" alt="{{$question->question_text}}" width="50">
                                        @else
                                            <span>null</span>
                                        @endif
                                    </td>
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
                                    <td class="d-flex justify-content-center">
                                        <a href="{{ route('simulasi-soal-tpk.edit', $question->id) }}" class="btn btn-warning btn-sm mr-1" data-toggle="tooltip" data-placement="top" title="Edit">
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
                <form action="{{route('import.simulasi-soal-tpk')}}" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-warning">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modals -->
    @foreach($simulasi_tpk_questions as $question)
        <div class="modal fade" id="deleteModal{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{$question->id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ route('simulasi-soal-tpk.destroy', $question->id) }}" method="POST">
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
        $(document).ready(function() {
            $('#dataTable').DataTable(); // Inisialisasi DataTables
            $('[data-toggle="tooltip"]').tooltip(); // Inisialisasi Tooltip
        });
    </script>
@endsection
