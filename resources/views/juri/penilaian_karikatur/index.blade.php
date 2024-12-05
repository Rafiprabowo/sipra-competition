@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
    <div class="col-sm-12 mx-auto mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Peserta</h6>
                <a href="{{ route('penilaian-karikatur.create') }}" class="btn btn-primary btn-md">Tambah Penilaian Karikatur</a>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Tabel Peserta -->
                    <div class="col-md-6">
                        <h5>Peserta</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="pesertaTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nisn</th>
                                    <th>Nama</th>
                                    <th>Pangkalan</th>
                                    <th>Regu</th>
                                    <th>Jenis Kelamin</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pesertas as $index => $peserta)
                                    <tr class="peserta-row" data-id="{{ $peserta->id }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $peserta->nisn }}</td>
                                        <td>{{ $peserta->nama }}</td>
                                        <td>{{ $peserta->pangkalan }}</td>
                                        <td>{{ $peserta->regu }}</td>
                                        <td>{{ $peserta->jenis_kelamin }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tabel Penilaian Karikatur -->
                    <div class="col-md-6">
                        <h5>Penilaian Karikatur <i class="fas fa-paint-brush"></i></h5>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="penilaianTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Nama Peserta</th>
                                    <th>Orisinalitas</th>
                                    <th>Kesesuaian Tema</th>
                                    <th>Kreativitas</th>
                                    <th>Pesan yang Disampaikan</th>
                                    <th>Teknik</th>
                                </tr>
                                </thead>
                                <tbody id="penilaianData">
                                @foreach($pesertas as $peserta)
                                    <tr>
                                        <td>{{ $peserta->nama }}</td>
                                        <!-- Menampilkan nilai jika sudah ada -->
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pesertaRows = document.querySelectorAll('.peserta-row');
            const penilaianData = document.getElementById('penilaianData');

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
