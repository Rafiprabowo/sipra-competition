@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 12px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Peserta</h6>
                <a href="{{ route('penilaian-karikatur.create') }}" class="btn btn-primary btn-md">Tambah Penilaian Karikatur</a>
            </div>

            <div class="card-body">
                <!-- Tabel Peserta -->
                <div class="mb-5">
                    <h5>Penilaian Peserta</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="pesertaTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>No</th>
                                {{-- <th>Nisn</th> --}}
                                <th>Nama</th>
                                <th>Pangkalan</th>
                                <th>Regu</th>
                                <th>Orisinalitas</th>
                                <th>Kesesuaian Tema</th>
                                <th>Kreativitas</th>
                                <th>Pesan yang Disampaikan</th>
                                <th>Teknik</th>
                                {{-- <th>Jenis Kelamin</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pesertas as $index => $peserta)
                                <tr class="peserta-row" data-id="{{ $peserta->id }}">
                                    <td>{{ $index + 1 }}</td>
                                    {{-- <td>{{ $peserta->nisn }}</td> --}}
                                    <td>{{ $peserta->nama }}</td>
                                    <td>{{ $peserta->pangkalan }}</td>
                                    <td>{{ $peserta->regu }}</td>
                                    {{-- <td>{{ $peserta->jenis_kelamin }}</td> --}}
                                    @foreach($pesertas as $peserta)

                                    @if($peserta->penilaian_karikatur)
                                        <td>{{ $peserta->penilaian_karikatur->orisinalitas }}</td>
                                        <td>{{ $peserta->penilaian_karikatur->kesesuaian_tema }}</td>
                                        <td>{{ $peserta->penilaian_karikatur->kreativitas }}</td>
                                        <td>{{ $peserta->penilaian_karikatur->pesan_yang_disampaikan }}</td>
                                        <td>{{ $peserta->penilaian_karikatur->teknik }}</td>
                                    @else
                                        <td>Belum dinilai</td>
                                        <td>Belum dinilai</td>
                                        <td>Belum dinilai</td>
                                        <td>Belum dinilai</td>
                                        <td>Belum dinilai</td>
                                    @endif
                            @endforeach

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
                pageLength: 5, // Set number of rows per page
                responsive: true
            });

            $('#penilaianTable').DataTable({
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
