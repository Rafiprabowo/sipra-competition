<!-- Pastikan jQuery dimuat terlebih dahulu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@extends('layouts.template')

@section('sidebar')
    @include('layouts.sidebar.juri')
@endsection

@section('content')
<div class="container" style="font-size: 11px;">
    <h2 class="mb-4" style="font-size: 11px;">Form Penilaian Vidio</h2>
    <!-- Form Penilaian -->
    <form action="{{ route('penilaian-vidio.store') }}" method="POST" id="penilaianForm">
        @csrf
        <!-- Filter -->
        <div class="mb-4">
            <!-- Filter Pangkalan -->
            <div class="mb-3">
                <label for="filter-pangkalan" class="form-label">Filter Pangkalan</label>
                <select id="filter-pangkalan" name="pembina_id" class="form-control" style="font-size: 11px;">
                    <option value="">-- Pilih Pangkalan --</option>
                    @foreach($pangkalans as $pangkalan)
                        <option value="{{ $pangkalan->id }}">{{ $pangkalan->pangkalan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Nama Pembina -->
            <div class="mb-3">
                <label for="pembina" class="form-label">Nama Pembina</label>
                <input type="text" id="nama_pembina" class="form-control" style="font-size: 11px;" readonly>
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
                        data-kriteria="{{ $bobot->kriteria_nilai }}"  style="font-size: 11px;"
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
            let pembina_id = $(this).val();
            let url = `/juri/vidio/${pembina_id}`;
            
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    console.log(response.data.nama)
                    $('#nama_pembina').val(response.data.nama)
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data pembina.');
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
