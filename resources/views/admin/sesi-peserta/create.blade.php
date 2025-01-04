@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
@endsection
@section('content')
    <div class="container-fluid" style="font-size: 11px;">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">Peserta Computer Based Test</h6>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Regu</th>
                                    <th>Pangkalan</th>                                
                                    <th>Jenis Kelamin</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesertas as $peserta)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $peserta->nama }}</td>
                                        <td>regu</td>
                                        <td>pangkalan</td>
                                        <td>{{ $peserta->jenis_kelamin }}</td>
                                        <td>
                                            <input type="checkbox" name="selected_pesertas[]" value="{{ $peserta->id }}">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="" class="btn btn-secondary" style="font-size: 11px;" title="Kembali">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Simpan">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function(){
            $('#dataTable').DataTable();
        });
    </script>
@endsection
