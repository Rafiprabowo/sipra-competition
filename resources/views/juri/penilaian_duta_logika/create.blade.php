<!-- Pastikan jQuery dimuat terlebih dahulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
<div class="container" style="font-size: 11px;">
    <h2 class="mb-4" style="font-size: 11px;">Form Penilaian Duta Logika</h2>
    <!-- Form Penilaian -->
    <form action="{{ route('penilaian-duta-logika.store') }}" method="POST" id="penilaianForm">
        @csrf
        <!-- Filter -->
        <div class="mb-4">
            <!-- Filter Pangkalan -->
            <div class="mb-3">
                <label for="filter-pangkalan" class="form-label">Filter Pangkalan</label>
                <select id="filter-pangkalan" class="form-control" style="font-size: 11px;">
                    <option value="">-- Pilih Pangkalan --</option>
                    @foreach($pangkalans as $pangkalan)
                        <option value="{{ $pangkalan->id }}">{{ $pangkalan->pangkalan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Nama Regu -->
            <div class="mb-3">
                <label for="regu_pembina" class="form-label">Filter Nama Regu</label>
                <select id="regu_pembina_id" name="regu_pembina_id" class="form-control" style="font-size: 11px;">

                </select>
                @error('regu_pembina_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Filter Peserta -->
            <div class="mb-3">
                <label for="peserta" class="form-label">Filter Peserta</label>
                <select id="peserta_id" name="peserta_id" class="form-control" style="font-size: 11px;">

                </select>
                @error('peserta_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Daftar kriteria nilai -->
        <input type="hidden" name="mata_lomba_id" value="{{$mata_lomba->id}}">
        <h5 class="mt-4" style="font-size: 11px;">Kriteria Nilai</h5>
        <div id="kriteria-container">
            @foreach($bobot_soals as $bobot)
            <div class="row align-items-center mb-3">
                <div class="col-md-4">
                    <label class="form-label">{{ $bobot->kriteria_nilai }}</label>
                    <span>Nilai (0 - {{ $bobot->bobot_soal }})</span>
                </div>
                <div class="col-md-3">
                    <input 
                        type="number" 
                        name="nilai[{{ $bobot->id }}]" 
                        class="form-control nilai-input" 
                        placeholder="Masukkan Nilai" 
                        data-max="{{ $bobot->bobot_soal }}" 
                        data-kriteria="{{ $bobot->kriteria_nilai }}" style="font-size: 11px;"
                        required>
                </div>
            </div>
            
            @endforeach
        </div>

        <!-- Tombol Submit -->
        <div class="mt-4">
            <button type="submit" class="btn btn-primary" style="font-size: 11px;" title="Simpan">
                <i class="fas fa-save"></i>
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#filter-pangkalan').change(function () {
            let pangkalan_id = $(this).val();
            let url = `/juri/regu/duta_logika/${pangkalan_id}`;
            
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.data && response.data.length > 0) {
                        $('#regu_pembina_id').empty().append('<option value="">Pilih Regu</option>');
                        response.data.forEach(function(regu) {
                            $('#regu_pembina_id').append(`<option value="${regu.id}">${regu.nama_regu}</option>`);
                        });
                    } else {
                        $('#regu_pembina_id').empty().append('<option value="">Tidak ada regu tersedia</option>');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data regu.');
                },
            });
        });

        $('#regu_pembina_id').change(function () {
            let regu_id = $(this).val();
            let url = `/juri/peserta/duta_logika/${regu_id}`;
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    if (response.data && response.data.length > 0) {
                        $('#peserta_id').empty().append('<option value="">Pilih Peserta</option>');
                        response.data.forEach(function(peserta) {
                            $('#peserta_id').append(`<option value="${peserta.id}">${peserta.nama}</option>`);
                        });
                    } else {
                        $('#peserta_id').empty().append('<option value="">Tidak ada peserta tersedia</option>');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data peserta.');
                },
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('#penilaianForm');

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah form terkirim langsung
            const inputs = form.querySelectorAll('.nilai-input');
            let isValid = true;
            let invalidFields = [];

            // Validasi setiap input nilai
            inputs.forEach(input => {
                const maxValue = parseFloat(input.dataset.max); // Nilai maksimal
                const kriteria = input.dataset.kriteria; // Nama kriteria
                const value = parseFloat(input.value);

                if (value < 0 || value > maxValue) {
                    isValid = false;
                    invalidFields.push({ kriteria, maxValue });
                }
            });

            if (!isValid) {
                // Tampilkan pesan error jika ada input yang tidak valid
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: invalidFields.map(field => 
                        `Nilai untuk kriteria "<strong>${field.kriteria}</strong>" harus berada di antara 0 dan ${field.maxValue}.`
                    ).join('<br>'),
                    confirmButtonColor: '#d33'
                });
            } else {
                // Submit form jika semua input valid
                form.submit();
            }
        });
    });
</script>

@endsection
