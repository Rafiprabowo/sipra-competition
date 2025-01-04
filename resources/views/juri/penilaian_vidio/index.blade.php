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
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Data Penilaian Vidio</h6>
                <a href="{{ route('penilaian-vidio.create') }}" class="btn btn-primary btn-md" title="Tambah" style="font-size: 11px;">
                    <i class="fas fa-plus"></i>
                </a>
            </div>

            <div class="card-body">
                <!-- Tabel Penilaian Vidio -->
                <div class="mb-5">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="penilaianVidioTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Juri</th>
                                <th>Nama Pembina</th>
                                <th>Total Nilai</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($penilaianVidios as $index => $penilaianVidio)
                                <tr class="penilaian-vidio-row" data-id="{{ $penilaianVidio->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $penilaianVidio->juri->nama }}</td>
                                    <td>{{ $penilaianVidio->pembina->nama }}</td>
                                    <td>{{ $penilaianVidio->total_nilai }}</td>
                                    <td>
                                        {{-- <a href="#" class="btn btn-info btn-sm" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('penilaian-vidio.edit', $penilaianVidio->id) }}" class="btn btn-warning btn-sm mx-2" title="Ubah">
                                            <i class="fas fa-edit"></i>
                                        </a>                                         --}}
                                    
                                        <!-- Form Hapus -->
                                        <form action="{{ route('penilaian-vidio.destroy', $penilaianVidio->id) }}" method="POST" style="display: inline;">
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

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize DataTable with Export buttons
            $('#penilaianVidioTable').DataTable({
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
                pageLength: 5, // Set number of rows per page
                responsive: true
            });
        });
    </script>
@endsection
