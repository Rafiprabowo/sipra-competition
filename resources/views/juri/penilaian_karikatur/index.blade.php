@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Data Penilaian Karikatur</h6>
                <a href="{{ route('penilaian-karikatur.create') }}" class="btn btn-primary btn-md" title="Tambah" style="font-size: 11px;">
                    <i class="fas fa-plus"></i>
                </a>
            </div>

            <div class="card-body">
                <!-- Tabel Peserta -->
                <div class="mb-5">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="pesertaTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Nama Juri</th>
                                <th>Total Nilai</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pesertas as $index => $peserta)
                                <tr class="peserta-row" data-id="{{ $peserta->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $peserta->nisn }}</td>
                                    <td>{{ $peserta->nama }}</td>
                                    <td>{{ Auth::user()->juri->nama }}</td>
                                    <td>{{ $peserta->penilaian_karikatur->total_nilai }}</td>
                                    <td>                            
                                        <!-- Form Hapus -->
                                        <form action="{{ route('penilaian-karikatur.destroy', $peserta->penilaian_karikatur->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus penilaian ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>                                  
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tabel Penilaian Karikatur -->
                
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize DataTable with Export buttons
            $('#pesertaTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"></i> Export Excel',
                        titleAttr: 'Export to Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i> Export PDF',
                        titleAttr: 'Export to PDF'
                    }
                ],
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection
