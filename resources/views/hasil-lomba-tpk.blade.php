@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        @endif

        @if (empty($rankingResults['ranked_participants']))
            <div class="alert alert-info" role="alert">
                Tidak ada data peserta yang tersedia saat ini.
            </div>
        @else
            <div class="card mb-4">
                <div class="card-header">
                    <h6>Hasil Lomba Tes Pengetahuan Kepramukaan</h6>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('pdf.lomba-tpk') }}" class="btn btn-primary mt-4 mr-2" style="font-size: 11px;">
                            <i class="fas fa-file-pdf"></i> Ekspor PDF
                        </a>
                        <a href="{{ route('excel.lomba-tpk') }}" class="btn btn-primary mt-4" style="font-size: 11px;">
                            <i class="fas fa-file-excel"></i> Ekspor Excel
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table-participants" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Peserta</th>
                                <th>Pangkalan</th>
                                <th>Regu</th>
                                <th>Nilai</th>
                                <th>Jenis Kelamin</th>
                                <th>Juara</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $allParticipants = collect();
                                foreach ($rankingResults['ranked_participants'] as $gender => $participants) {
                                    $allParticipants = $allParticipants->merge($participants);
                                }
                            @endphp

                            @foreach ($allParticipants as $index => $participant)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $participant->peserta->nama ?? 'N/A' }}</td>
                                    <td>{{ $participant->peserta->regu_pembina->pembina->pangkalan ?? 'N/A' }}</td>
                                    <td>{{ $participant->peserta->regu_pembina->nama_regu ?? 'N/A' }}</td>
                                    <td>{{ $participant->score }}</td>
                                    <td>{{ $participant->peserta->jenis_kelamin }}</td>
                                    <td>{{ $participant->rank ? 'Juara ' . $participant->rank : '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        <div class="d-flex justify-content-start mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="font-size: 11px;" title="Kembali">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#table-participants').DataTable();
        });
    </script>
@endsection
