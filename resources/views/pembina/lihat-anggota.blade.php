@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.pembina')
@endsection
@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 11px;">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert"> {{ session('error') }} </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">List Anggota Peserta Lomba</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center;">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Peserta</th>
                            <th>Nama Regu</th>
                            <th>Jenis Kelamin</th>
                            <th>Mata Lomba</th>
                        </tr>
                        </thead>
                        <tbody>
                          @foreach($pembina->regu as $regu)
                          @foreach($regu->peserta as $index => $p)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$p->nisn}}</td>
                                <td>{{$p->nama}}</td>
                                <td>{{$regu->nama_regu}}</td>
                                <td>{{$p->jenis_kelamin}}</td>
                                <td>{{$p->mata_lomba->nama}}</td>
                            </tr>
                          @endforeach
                          @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
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
