@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.pembina')
@endsection

@section('content')
    <div id="content" class="container-fluid mt-4">
        @if (session('success'))
            <div class="alert alert-success" role="alert"> {{ session('success') }} </div>
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
        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs navbar-light" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="data-pembina-tab" data-toggle="tab" href="#data-pembina" role="tab"
                   aria-controls="data-pembina" aria-selected="true">Data Pembina</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="regu-tab" data-toggle="tab" href="#regu" role="tab" aria-controls="regu"
                   aria-selected="false">Regu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="peserta-tab" data-toggle="tab" href="#peserta" role="tab"
                   aria-controls="peserta" aria-selected="false">Peserta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload"
                   aria-selected="false">Upload Berkas</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <!-- Data Pembina -->
            <div class="tab-pane fade show active" id="data-pembina" role="tabpanel" aria-labelledby="data-pembina-tab">
                <div class="card container-md mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-5"><strong>Form Data Pembina</strong></h5>
                        <form action="{{ route('pembina.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
                            <div class="form-group">
                                <label for="nama"><i class="fas fa-user"></i> Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                       placeholder="Masukkan nama pembina" required>
                            </div>
                            <div class="form-group">
                                <label for="kwartir_cabang"><i class="fas fa-building"></i> Kwartir Cabang</label>
                                <input type="text" class="form-control" id="kwartir_cabang" name="kwartir_cabang"
                                       placeholder="Masukkan kwartir cabang" required>
                            </div>
                            <div class="form-group">
                                <label for="pangkalan"><i class="fas fa-university"></i> Pangkalan</label>
                                <input type="text" class="form-control" id="pangkalan" name="pangkalan"
                                       placeholder="Masukkan nama pangkalan" required>
                            </div>
                            <div class="form-group">
                                <label for="nama_gudep"><i class="fas fa-users"></i> Nama Gudep</label>
                                <input type="text" class="form-control" id="nama_gudep" name="nama_gudep"
                                       placeholder="Masukkan nama gudep" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir"><i class="fas fa-calendar"></i> Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin"><i class="fas fa-venus-mars"></i> Jenis Kelamin</label>
                                <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="" disabled selected>Pilih jenis kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="alamat"><i class="fas fa-map-marker-alt"></i> Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"
                                          placeholder="Masukkan alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="no_hp"><i class="fas fa-phone"></i> No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp"
                                       placeholder="Masukkan nomor HP" required>
                            </div>
                            <div class="form-group">
                                <label for="pengalaman_pembina"><i class="fas fa-history"></i> Pengalaman
                                    Pembina</label>
                                <textarea class="form-control" id="pengalaman_pembina" name="pengalaman_pembina"
                                          rows="3" placeholder="Masukkan pengalaman sebagai pembina"
                                          required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="pekerjaan"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan"
                                       placeholder="Masukkan pekerjaan saat ini" required>
                            </div>
                            <button type="button" class="btn btn-success mt-4" data-toggle="modal"
                                    data-target="#pembinaModal">
                                Simpan
                            </button>

                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="pembinaModal" tabindex="-1" role="dialog"
                                 aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin data yang dimasukkan sudah benar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Regu -->
            <div class="tab-pane fade" id="regu" role="tabpanel" aria-labelledby="regu-tab">
                <div class="container-md card mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-5"><strong>Form Input Regu</strong></h5>
                        <form id="formRegu" action="{{ route('regu.store') }}" method="POST" class="needs-validation"
                              novalidate>
                            @csrf
                            <!-- Kategori Putra -->
                            <h5><strong>Putra</strong></h5>
                            <div id="putra-container">
                                <div class="regu-group d-flex align-items-center mb-2">
                                    <div class="form-group flex-grow-1">
                                        <label for="nama_regu">Nama Regu <span class="regu-number">1</span></label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control" id="nama_regu"
                                                   name="nama_regu[pa][]" placeholder="Masukkan nama regu putra"
                                                   required>
                                            <button type="button" class="btn btn-primary ml-2 add-regu"><i
                                                    class="fas fa-plus-circle"></i></button>
                                            <button type="button" class="btn btn-danger ml-2 remove-regu"><i
                                                    class="fas fa-minus-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="my-3"></div>
                            <!-- Kategori Putri -->
                            <h5 class="mb-3"><strong>Putri</strong></h5>
                            <div id="putri-container">
                                <div class="regu-group d-flex align-items-center mb-2">
                                    <div class="form-group flex-grow-1">
                                        <label for="nama_regu">Nama Regu <span class="regu-number">1</span></label>
                                        <div class="d-flex">
                                            <input type="text" class="form-control" id="nama_regu"
                                                   name="nama_regu[pi][]" placeholder="Masukkan nama regu putri"
                                                   required>
                                            <button type="button" class="btn btn-primary ml-2 add-regu"><i
                                                    class="fas fa-plus-circle"></i></button>
                                            <button type="button" class="btn btn-danger ml-2 remove-regu"><i
                                                    class="fas fa-minus-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Simpan -->
                            <button type="button" class="btn btn-success d-block mt-4" data-toggle="modal"
                                    data-target="#reguModal">
                                Simpan
                            </button>

                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="reguModal" tabindex="-1" role="dialog"
                                 aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin data yang dimasukkan sudah benar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Peserta -->
            <div class="tab-pane fade" id="peserta" role="tabpanel" aria-labelledby="peserta-tab">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title mb-5"><strong>Form Input Peserta</strong></h5>
                        <form action="{{ route('peserta.store') }}" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <!-- Regu Pembina -->
                            @foreach($reguPembinas as $reguPembina)
                                <h5><strong>Nama Regu: {{ $reguPembina->nama_regu }}</strong></h5>
                                <div id="regu-container-{{ $reguPembina->id }}" class="regu-container">
                                    <div class="participant-group d-flex align-items-center mb-2" data-index="1">
                                        <div class="form-group flex-grow-1">
                                            <label for="nisn_{{ $reguPembina->id }}_1">NISN</label>
                                            <input type="text" class="form-control" id="nisn_{{ $reguPembina->id }}_1"
                                                   name="nisn[{{ $reguPembina->id }}][]" placeholder="Masukkan NISN"
                                                   required>
                                        </div>
                                        <div class="form-group flex-grow-1 ml-2">
                                            <label for="nama_{{ $reguPembina->id }}_1">Nama</label>
                                            <input type="text" class="form-control" id="nama_{{ $reguPembina->id }}_1"
                                                   name="nama[{{ $reguPembina->id }}][]"
                                                   placeholder="Masukkan Nama Peserta" required>
                                        </div>
                                        <div class="form-group flex-grow-1 ml-2">
                                            <label for="mata_lomba_id_{{ $reguPembina->id }}_1">Mata Lomba</label>
                                            <select class="form-control" id="mata_lomba_id_{{ $reguPembina->id }}_1"
                                                    name="mata_lomba_id[{{ $reguPembina->id }}][]" required>
                                                @foreach($mataLombas as $mataLomba)
                                                    <option value="{{ $mataLomba->id }}">{{ $mataLomba->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex align-items-end ml-2" style="margin-top: 1rem;">
                                            <button type="button" class="btn btn-primary add-participant"
                                                    data-regu-id="{{ $reguPembina->id }}"><i
                                                    class="fas fa-plus-circle"></i></button>
                                            <button type="button" class="btn btn-danger ml-2 remove-participant"><i
                                                    class="fas fa-minus-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach

                            <!-- Tombol Simpan -->
                            <button type="button" class="btn btn-success d-block mt-4" data-toggle="modal"
                                    data-target="#pesertaModal">
                                Simpan
                            </button>

                            <!-- Modal Konfirmasi -->
                            <div class="modal fade" id="pesertaModal" tabindex="-1" role="dialog"
                                 aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Konfirmasi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin data yang dimasukkan sudah benar?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal
                                            </button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tab Upload berkas -->
            <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Dokumen Syarat Umum</h5>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Dokumen</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>FP-06: Surat Pernyataan Pimpinan PT Daftar Kerjasama Industri</td>
                                        <td><a href="#"><i class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Lampiran FP-03: Pernyataan tentang Status PT dan Program Studi (ber-kop
                                            PT)
                                        </td>
                                        <td><a href="#"><i class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Lampiran FK-03: Rekomendasi Pimpinan PT (ber-kop PT)</td>
                                        <td><a href="#"><i class="fa fa-download"></i></a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Lampiran FU-02: Surat Rekomendasi Pimpinan PT (KOP PT)</td>
                                        <td><a href="#"><i class="fa fa-download"></i></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>Unggah Dokumen</h5>
                                <form>
                                    <div class="form-group">
                                        <label for="documentType">Pilih Jenis Dokumen</label>
                                        <select class="form-control" id="documentType">
                                            <option>Pilih</option>
                                            <!-- Tambahkan pilihan jenis dokumen di sini -->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="documentFile">Pilih File</label>
                                        <input type="file" class="form-control-file" id="documentFile">
                                        <small class="form-text text-muted">Silahkan pilih file dokumen anda. Ukuran
                                            maksimal file 2 MB. Jenis dokumen yang diijinkan adalah: jpg, doc, docx, dan
                                            pdf</small>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection


