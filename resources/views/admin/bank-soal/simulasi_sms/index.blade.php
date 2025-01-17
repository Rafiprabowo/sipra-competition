@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 12px;">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bank Soal Simulasi Semaphore Morse</li>
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
                <h5>Bank Soal Simulasi Semaphore Morse</h5>
                <div class="d-flex">
                    <!-- Tombol Import Excel -->
                    <button class="btn btn-warning mr-2" data-toggle="modal" data-target="#importModal" style="font-size: 11px;" title="Import Excel">
                        <i class="fas fa-file-excel"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="semaphore-tab" data-toggle="tab" href="#semaphore" role="tab" aria-controls="semaphore" aria-selected="true">Semaphore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="morse-tab" data-toggle="tab" href="#morse" role="tab" aria-controls="morse" aria-selected="false">Morse</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="semaphore" role="tabpanel" aria-labelledby="semaphore-tab">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered text-center" id="semaphoreTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kata</th>
                                        <th>Jenis</th>
                                        <th>Gambar</th>
                                        <th>Tingkat Kesulitan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simulasi_sms_questions->where('type', \App\Enums\QuestionType::SEMAPHORE->value) as $question)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $question->word }}</td>
                                            <td>Semaphore</td>
                                            <td>
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    @foreach ($question->symbols as $symbol)
                                                        <div class="symbol-container text-center" style="margin-right: 10px; margin-bottom: 5px;">
                                                            <img src="{{ Storage::url($symbol->image) }}" alt="{{ $symbol->letter }}" class="symbol-image">
                                                            <div>{{ $symbol->letter }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>{{ ucfirst($question->difficulty) }}</td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('simulasi-soal-sms.edit', $question->id) }}" class="btn btn-warning btn-sm mr-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $question->id }}" title="Delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="morse" role="tabpanel" aria-labelledby="morse-tab">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered text-center" id="morseTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kata</th>
                                        <th>Jenis</th>
                                        <th>Gambar</th>
                                        <th>Tingkat Kesulitan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simulasi_sms_questions->where('type', \App\Enums\QuestionType::MORSE->value) as $question)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $question->word }}</td>
                                            <td>Morse</td>
                                            <td>
                                                <div class="d-flex flex-wrap justify-content-center">
                                                    @foreach ($question->symbols as $symbol)
                                                        <div class="symbol-container text-center" style="margin-right: 10px; margin-bottom: 5px;">
                                                            <img src="{{ Storage::url($symbol->image) }}" alt="{{ $symbol->letter }}" class="symbol-image">
                                                            <div>{{ $symbol->letter }}</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>{{ ucfirst($question->difficulty) }}</td>
                                            <td class="d-flex justify-content-center">
                                                <a href="{{ route('simulasi-soal-sms.edit', $question->id) }}" class="btn btn-warning btn-sm mr-1" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $question->id }}" title="Delete">
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
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Simulasi Soal dari Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('import.simulasi-soal-sms') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file">Pilih File Excel</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modals -->
    @foreach ($simulasi_sms_questions as $question)
        <div class="modal fade" id="deleteModal{{ $question->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $question->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $question->id }}">Hapus Simulasi Soal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus soal ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <form action="{{ route('simulasi-soal-sms.destroy', $question->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('h-script')
    <style>
        .symbol-image {
    height: 50px;
}

    </style>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#morseTable').DataTable(); // Inisialisasi DataTables
            $('#semaphoreTable').DataTable(); // Inisialisasi DataTables
            $('[data-toggle="tooltip"]').tooltip(); // Inisialisasi Tooltip
        });
    </script>
@endsection