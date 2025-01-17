<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\MataLomba;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PesertaExport; 
use PDF;
use Illuminate\Support\Facades\DB;

class HasilNilaiKarikaturController extends Controller
{
    public function index() {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::KARIKATUR->value)->first();
    
        if (!$mata_lomba) {
            return redirect()->route('admin.dashboard')->with('error', 'Mohon maaf, masukkan mata lomba Karikatur untuk membuka penilaian.');
        }

        // Fetch and process participants by gender
        $putra = Peserta::with('penilaian_karikatur')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putra')
            ->whereHas('penilaian_karikatur')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_karikatur->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();
    
        $putri = Peserta::with('penilaian_karikatur')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putri')
            ->whereHas('penilaian_karikatur')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_karikatur->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();
    
        // Assign rankings and update the database for Putra
        $putra->each(function ($peserta, $index) {
            if ($index == 0) {
                $rank = 'Juara 1';
            } elseif ($index == 1) {
                $rank = 'Juara 2';
            } elseif ($index == 2) {
                $rank = 'Juara 3';
            } else {
                $rank = null;
            }
            $peserta->penilaian_karikatur->update(['rangking' => $rank]);
        });
    
        // Assign rankings and update the database for Putri
        $putri->each(function ($peserta, $index) {
            if ($index == 0) {
                $rank = 'Juara 1';
            } elseif ($index == 1) {
                $rank = 'Juara 2';
            } elseif ($index == 2) {
                $rank = 'Juara 3';
            } else {
                $rank = null;
            }
            $peserta->penilaian_karikatur->update(['rangking' => $rank]);
        });
    
        return view('admin.hasil_nilai.nilai_karikatur', compact('putra', 'putri'));
    }      

    public function exportPDFKarikatur(Request $request)
    {
        $tab = $request->input('tab');

        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::KARIKATUR->value)->first();
        
        $putra = Peserta::with('penilaian_karikatur', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putra')
            ->whereHas('penilaian_karikatur')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_karikatur->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();
        
        $putri = Peserta::with('penilaian_karikatur', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putri')
            ->whereHas('penilaian_karikatur')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_karikatur->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();

        $data = compact('putra', 'putri', 'tab', 'mata_lomba');

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
        return $pdf->download('penilaian_karikatur.pdf');
    }

    public function exportExcelKarikatur()
    {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::KARIKATUR->value)->first();

        // Data Putra
        $dataPutra = Peserta::with('penilaian_karikatur', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putra')
            ->whereHas('penilaian_karikatur')
            ->get()
            ->map(function ($peserta) {
                return [
                    'no' => $peserta->id,
                    'nama' => $peserta->nama,
                    'nama_regu' => $peserta->regu_pembina->nama_regu,
                    'pangkalan' => $peserta->regu_pembina->pembina->pangkalan,
                    'jenis_kelamin' => $peserta->jenis_kelamin,
                    'nilai_akhir' => $peserta->penilaian_karikatur->total_nilai,
                    'rangking' => $peserta->penilaian_karikatur->rangking,
                ];
            })->sortByDesc('nilai_akhir')->values()->toArray();

        // Data Putri
        $dataPutri = Peserta::with('penilaian_karikatur', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putri')
            ->whereHas('penilaian_karikatur')
            ->get()
            ->map(function ($peserta) {
                return [
                    'no' => $peserta->id,
                    'nama' => $peserta->nama,
                    'nama_regu' => $peserta->regu_pembina->nama_regu,
                    'pangkalan' => $peserta->regu_pembina->pembina->pangkalan,
                    'jenis_kelamin' => $peserta->jenis_kelamin,
                    'nilai_akhir' => $peserta->penilaian_karikatur->total_nilai,
                    'rangking' => $peserta->penilaian_karikatur->rangking,
                ];
            })->sortByDesc('nilai_akhir')->values()->toArray();

        $sheets = [
            new PenilaianKarikaturSheet($dataPutra, 'Putra'),
            new PenilaianKarikaturSheet($dataPutri, 'Putri')
        ];

        return Excel::download(new MultipleSheetsExport($sheets), 'penilaian_karikatur.xlsx');
    }
}

class PenilaianKarikaturSheet implements FromCollection, WithHeadings
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


