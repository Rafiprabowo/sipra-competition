@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
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
    <div class="card shadow mb-4" style="font-size: 10px;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary" style="font-size: 11px;">List Status Validasi Persyaratan Lomba</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="text-align: center">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pembina</th>
            <th>Pangkalan</th>
            <th>Dokumen dan Status</th>
            <th>Status Finalisasi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($finalisasis as $index => $finalisasi)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $finalisasi->pembina->nama }}</td>
                <td>{{ $finalisasi->pembina->pangkalan }}</td>
                <td>
                    <ul class="list-group">
                        @foreach($finalisasi->pembina->upload_dokumen as $doc)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div>
                                    {{ $doc->template_dokumen->nama }}
                                </div>
                                <span class="badge ml-2 {{ $doc->status == 1 ? 'badge-success' : ($doc->status == 0 ? 'badge-danger' : 'badge-warning') }}">
                                    {{ $doc->status == 1 ? 'Tervalidasi' : ($doc->status == 0 ? 'Tidak Tervalidasi' : 'Menunggu Verifikasi') }}
                                </span>
                            </div>
                            <a href="{{ route('viewFile', basename($doc->file)) }}" class="btn btn-info btn-sm" title="Lihat">
                                <i class="fa fa-eye"></i>
                            </a>
                        </li>                        
                        @endforeach
                    </ul>
                </td>
                <td>
                    @if($finalisasi && $finalisasi->status == 1)
                        <span class="badge badge-success">Lolos Verifikasi</span>
                    @elseif($finalisasi && $finalisasi->status === 0)
                        <span class="badge badge-danger">Tidak Lolos Verifikasi</span>
                    @else
                        <span class="badge badge-warning">Menunggu Verifikasi</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('finalisasi.edit', $finalisasi->id) }}" class="btn btn-warning btn-sm" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" class="text-center">
                <i class="fas fa-info-circle text-warning"></i> <strong>Pemberitahuan:</strong> Data Pangkalan yang belum lolos validasi tolong mengecek kelengkapan registrasi lomba oleh Pembina masing-masing.
            </td>
        </tr>
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
