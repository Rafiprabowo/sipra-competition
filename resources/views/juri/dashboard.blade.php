@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection
@section('content')
    <div class="col-sm-12 ms-2 me-2 mt-4" style="font-size: 12px;">
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
                <h6 class="m-0 font-weight-bold text-primary">List Status Validasi Persyaratan Lomba</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembina</th>
                            <th>Pangkalan</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- @foreach($peserta as $index => $value) --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        {{-- @endforeach --}}
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="8" class="text-center">
                                <i class="fas fa-info-circle text-warning"></i> <strong>Pemberitahuan:</strong> Data Pangkalan yang belum lolos validasi tolong mengecek kelengkapan registrasi lomba oleh Pembina masing-masing.
                            </td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
