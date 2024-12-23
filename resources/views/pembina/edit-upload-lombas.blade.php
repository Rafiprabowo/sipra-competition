@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.pembina')
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
        <div class="card-header">Edit Form Upload Lomba</div>
        <div class="card-body">
            <form action="{{ route('upload_lombas.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3"> 
                    <label for="nama_pembina" class="form-label">Nama Pembina</label> 
                    <table class="table"> 
                        <thead> 
                            <tr> 
                                <th>No</th> 
                                <th>Nama Pembina</th> 
                                <th>Pangkalan</th> 
                                <th>Kwartir Cabang</th> 
                            </tr> 
                        </thead> 
                        <tbody>
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->pembina->nama }}</td>
                                    <td>{{ $item->pembina->pangkalan }}</td>
                                    <td>{{ $item->pembina->kwartir_cabang }}</td>  
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
                <div class="mb-3">
                    <label for="mata_lomba_id" class="form-label">Mata Lomba</label>
                    <select class="form-control" id="mata_lomba_id" name="mata_lomba_id" required>
                        @foreach (\App\Models\MataLomba::whereIn('nama', ['foto', 'video'])->get() as $mataLomba)
                            <option value="{{ $mataLomba->id }}">{{ $mataLomba->nama }}</option>
                        @endforeach
                    </select>
                </div>                
                <div class="mb-3">
                    <label for="nama_peserta" class="form-label">Nama Peserta</label>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama Peserta</th>
                                <th>Regu</th>
                                <th>Pangkalan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->peserta->nisn }}</td>
                                    <td>{{ $item->peserta->nama }}</td>
                                    <td>{{ $item->regu_pembina->nama_regu }}</td>
                                    <td>{{ $item->pembina->pangkalan }}</td>  
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mb-3">
                    <label for="upload_foto" class="form-label">Upload Foto</label>
                    <input type="file" class="form-control" id="upload_foto" name="upload_foto">
                </div>
                <div class="mb-3">
                    <label for="upload_video" class="form-label">Upload Video</label>
                    <input type="text" class="form-control" id="upload_video" name="upload_video" placeholder="Masukkan link video">
                </div>
                @foreach ($data as $index => $item)
                <div class="mb-3">
                    <label for="tanggal_update" class="form-label">Tanggal Update</label>
                    <input type="text" class="form-control" id="tanggal_update" name="tanggal_update" value="{{ $item->updated_at }}">
                </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
