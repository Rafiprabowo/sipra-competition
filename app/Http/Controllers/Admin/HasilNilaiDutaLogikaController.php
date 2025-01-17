<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\MataLomba;
use Maatwebsite\Excel\Facades\Excel; 
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PesertaExport;
use Dompdf\Dompdf;
use PDF;
use Illuminate\Support\Facades\DB;

class HasilNilaiDutaLogikaController extends Controller
{
    public function index() {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::DUTALOGIKA->value)->first();
    
        if (!$mata_lomba) {
            return redirect()->route('admin.dashboard')->with('error', 'Mohon maaf, masukkan mata lomba DUTA LOGIKA untuk membuka penilaian.');
        }

        // Fetch and combine participants by gender
        $peserta = Peserta::with('penilaian_duta_logika')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->whereHas('penilaian_duta_logika')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_duta_logika->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();

        // Assign rankings and update the database
        $peserta->each(function ($peserta, $index) {
            if ($index == 0) {
                $rank = 'Juara 1';
            } elseif ($index == 1) {
                $rank = 'Juara 2';
            } elseif ($index == 2) {
                $rank = 'Juara 3';
            } else {
                $rank = null;
            }
            $peserta->penilaian_duta_logika->update(['rangking' => $rank]);
        });

        return view('admin.hasil_nilai.nilai_duta_logika', compact('peserta'));
    }

    public function exportPDFDutaLogika() {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::DUTALOGIKA->value)->first();
        $tab = 'penilaian_dutaLogika';

        $peserta = Peserta::with('penilaian_duta_logika', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->whereHas('penilaian_duta_logika')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_duta_logika->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();

        $data = compact('peserta', 'mata_lomba', 'tab');

        $ketuaPelaksanas = User::where('role', 'ketua_pelaksana')->get();

        $pathLogoKiri = public_path('img/logo-kiri.png');
        $pathLogoKanan = public_path('img/logo-kanan.jpg');
        $typeLogoKiri = pathinfo($pathLogoKiri, PATHINFO_EXTENSION);
        $typeLogoKanan = pathinfo($pathLogoKanan, PATHINFO_EXTENSION);
        $dataLogoKiri = file_get_contents($pathLogoKiri);
        $dataLogoKanan = file_get_contents($pathLogoKanan);
        $base64LogoKiri = 'data:image/' . $typeLogoKiri . ';base64,' . base64_encode($dataLogoKiri);
        $base64LogoKanan = 'data:image/' . $typeLogoKanan . ';base64,' . base64_encode($dataLogoKanan);

        $data['base64LogoKiri'] = $base64LogoKiri;
        $data['base64LogoKanan'] = $base64LogoKanan;
        $data['ketuaPelaksanas'] = $ketuaPelaksanas;
        
        $pdf = PDF::loadView('admin.hasil_nilai.template', $data)->setPaper('a4', 'portrait');
        return $pdf->download('penilaian_duta_logika.pdf');
    }

    public function exportExcelDutaLogika()
    {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::DUTALOGIKA->value)->first();

        // Data peserta
        $data = Peserta::with('penilaian_duta_logika', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->whereHas('penilaian_duta_logika')
            ->get()
            ->map(function ($peserta) {
                return [
                    'no' => $peserta->id,
                    'nama' => $peserta->nama,
                    'nama_regu' => $peserta->regu_pembina->nama_regu,
                    'pangkalan' => $peserta->regu_pembina->pembina->pangkalan,
                    'jenis_kelamin' => $peserta->jenis_kelamin,
                    'nilai_akhir' => $peserta->penilaian_duta_logika->total_nilai,
                    'rangking' => $peserta->penilaian_duta_logika->rangking,
                ];
            })->sortByDesc('nilai_akhir')->values()->toArray();

        $sheets = [
            new PenilaianDutaLogikaSheet($data, 'Penilaian Duta Logika')
        ];

        return Excel::download(new MultipleSheetsExport($sheets), 'penilaian_duta_logika.xlsx');
    }
}

class PenilaianDutaLogikaSheet implements FromCollection, WithHeadings
{
    private $data;
    private $title;

    public function __construct(array $data, string $title)
    {
        $this->data = $data;
        $this->title = $title;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama',
            'Nama Regu',
            'Pangkalan',
            'Jenis Kelamin',
            'Nilai Akhir',
            'Rangking'
        ];
    }

    public function title(): string
    {
        return $this->title;
    }
}

class MultipleSheetsExport implements WithMultipleSheets
{
    private $sheets;

    public function __construct(array $sheets)
    {
        $this->sheets = $sheets;
    }

    public function sheets(): array
    {
        return $this->sheets;
    }
}



