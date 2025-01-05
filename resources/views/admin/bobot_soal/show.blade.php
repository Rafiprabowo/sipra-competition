@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection

@section('content')
<div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">
    @if (session('success'))
        <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Data Lihat Bobot Soal</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
                    <thead>
                        <tr>
                            <th>Mata Lomba</th>
                            <th>Kriteria Nilai</th>
                            <th>Bobot</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bobot_soals as $bobot)
                            <tr>
                                <td>{{ $bobot->mata_lomba->nama }}</td>
                                <td>{{ $bobot->kriteria_nilai }}</td>
                                <td>{{ $bobot->bobot_soal }}</td>
                                <td>
                                    <a href="{{ route('admin.bobot-soal.edit', $bobot->id) }}" class="btn btn-warning btn-sm mx-3" title="Ubah" style="font-size: 11px;">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.bobot-soal.deleteRow', $bobot->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="kriteria_nilai" value="{{ $bobot->kriteria_nilai }}" style="font-size: 11px;">
                                        <button type="submit" class="btn btn-danger" title="Hapus" style="font-size: 11px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"><strong>Total Bobot</strong></td>
                            <td colspan="2"><strong>{{ $bobot_soals->sum('bobot_soal') }}</strong></td>
                        </tr>
                    </tfoot>
                </table>            
                <a href="{{ route('admin.bobot-soal.index') }}" class="btn btn-secondary" title="Kembali" style="font-size: 11px;">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
