@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.peserta')
@endsection

@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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

    <div class="card">
        <div class="card-header">Form Upload Lomba</div>
        <div class="card-body">
            <form action="{{ route('upload_lombas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="upload_poster" class="form-label">Upload Poster</label>
                    <input type="file" class="form-control" id="upload_poster" name="upload_poster">
                </div>
                <div class="mb-3">
                    <label for="upload_video" class="form-label">Link Video</label>
                    <input type="text" class="form-control" id="upload_video" name="upload_video" placeholder="Masukkan link video">
                </div>                
                <div class="mb-3">
                    <label for="peserta_id" class="form-label">Peserta</label>
                    <select class="form-control" id="peserta_id" name="peserta_id" required>
                        @foreach (\App\Models\Peserta::all() as $peserta)
                            <option value="{{ $peserta->id }}">{{ $peserta->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="mata_lomba_id" class="form-label">Mata Lomba</label>
                    <select class="form-control" id="mata_lomba_id" name="mata_lomba_id" required>
                        @foreach (\App\Models\MataLomba::all() as $mataLomba)
                            <option value="{{ $mataLomba->id }}">{{ $mataLomba->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pembina_id" class="form-label">Nama Pangkalan</label>
                    <select class="form-control" id="pembina_id" name="pembina_id" required>
                        @foreach (\App\Models\Pembina::all() as $pembina)
                            <option value="{{ $pembina->id }}">{{ $pembina->pangkalan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="regu_pembina_id" class="form-label">Nama Regu</label>
                    <select class="form-control" id="regu_pembina_id" name="regu_pembina_id" required>
                        @foreach (\App\Models\ReguPembina::all() as $reguPembina)
                            <option value="{{ $reguPembina->id }}">{{ $reguPembina->nama_regu }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

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
                <h6 class="m-0 font-weight-bold text-primary">Data Upload Berkas Lomba</h6>
            </div>
    
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Poster</th>
                                <th>Video</th>
                                <th>Peserta</th>
                                <th>Mata Lomba</th>
                                <th>Pangkalan</th>
                                <th>Regu</th>
                                <th>Tanggal Update</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->upload_poster }}</td>
                                    <td>{{ $item->upload_video }}</td>
                                    <td>{{ $item->peserta->nama }}</td>
                                    <td>{{ $item->mataLomba->nama }}</td>
                                    <td>{{ $item->pembina->pangkalan }}</td>
                                    <td>{{ $item->regu_pembina->nama_regu }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('upload_lombas.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('upload_lombas.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>   
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9" class="text-center">
                                    <i class="fas fa-info-circle text-warning"></i> <strong>Pemberitahuan:</strong> Data Pangkalan yang belum lolos validasi tolong mengecek kelengkapan registrasi lomba oleh Pembina masing-masing.
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>    
</div>
@endsection
