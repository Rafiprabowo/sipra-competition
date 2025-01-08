@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="col-sm-12 ms-2 me-2" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 16px;">Data Bobot Soal</h6>
                                <a href="{{route('admin.bobot-soal.create')}}" class="btn btn-primary btn-md" style="font-size: 11px;" title="Tambah">
                                    <i class="fas fa-plus"></i>
                                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Lomba</th>
                                <th>Total Bobot</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $uniqueBobotSoal = $bobot_soal->unique('mata_lomba_id');
                                $rowNumber = 1; // Variabel untuk menghitung indeks tampilan
                            @endphp
                            @foreach($uniqueBobotSoal as $value)
                                <tr>
                                    <!-- Indeks yang hanya dihitung berdasarkan urutan tampilan -->
                                    <td>{{ $rowNumber }}</td>
                                    <td>{{ $value->mata_lomba->nama }}</td>
                                    <td>{{ $value->total_bobot }}</td>
                                    <td>
                                        <a href="{{ route('admin.bobot-soal.show', $value->mata_lomba_id) }}" class="btn btn-info btn-sm" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>                                        
                                        
                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.bobot-soal.destroy', $value->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @php
                                    $rowNumber++; // Increment variabel setiap kali ada baris
                                @endphp
                            @endforeach
                        </tbody>
                    </table>            
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $('#dataTable').DataTable({
                pageLength: 10, // Set number of rows per page
                responsive: true,
                searching: true,
                ordering: true
            });
        });
    </script>
@endsection
