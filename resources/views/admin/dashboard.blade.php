@extends('layouts.template')
@section('sidebar')
    @include('layouts.sidebar.admin')
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
    <div class="card shadow mb-4" style="font-size: 12px;">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">List Status Validasi Persyaratan Lomba</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0" style="font-size: 16px;">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Nama Pembina</th>
            <th>Pangkalan</th>
            <th>Dokumen</th>
            <th>Status</th>
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
                @foreach($finalisasi->pembina->upload_dokumen as $doc)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                       Nama Dokumen :  {{ $doc->template_dokumen->nama }}
                        <a href="{{ route('viewFile', basename($doc->file)) }}" class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i> Lihat
                        </a>
                    </li>
                @endforeach
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
                <form action="{{ route('finalisasi.approve', $finalisasi->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                        <i class="fas fa-check"></i> Setujui
                    </button>
                </form>
                <form action="{{ route('finalisasi.reject', $finalisasi->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                </form>
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
@endsection
