<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenilaianVidio;
use App\Models\MataLomba;
use Maatwebsite\Excel\Facades\Excel; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PesertaExport; 
use PDF;
use Illuminate\Support\Facades\DB;

class HasilNilaiVidioController extends Controller
{
    public function index()
    {
        // Ambil mata lomba
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::VIDIO->value)->first();

        if (!$mata_lomba) {
            return redirect()->route('admin.dashboard')->with('error', 'Mohon maaf, masukkan mata lomba Vidio untuk membuka penilaian.');
        }

        // Ambil penilaian vidio dengan relasi dan filter duplikat berdasarkan pembina_id
        $penilaianVidios = PenilaianVidio::with('juri', 'pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->get()
            ->unique('pembina_id')
            ->sortByDesc('total_nilai')->values();

        // Assign rankings and update the database
        $penilaianVidios->each(function ($penilaian_vidio, $index) {
            if ($index == 0) {
                $rank = 'Juara 1';
            } elseif ($index == 1) {
                $rank = 'Juara 2';
            } elseif ($index == 2) {
                $rank = 'Juara 3';
            } else {
                $rank = null;
            }
            $penilaian_vidio->update(['rangking' => $rank]);
        });

        return view('admin.hasil_nilai.nilai_vidio', compact('penilaianVidios'));
    }      

    public function exportPDFVidio(Request $request)
    {
        $tab = 'penilaian_vidio';

        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::VIDIO->value)->first();
        
        $penilaianVidios = PenilaianVidio::with('juri', 'pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->get()
            ->unique('pembina_id')
            ->sortByDesc('total_nilai')->values();

        $data = compact('penilaianVidios', 'mata_lomba', 'tab');

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
        return $pdf->download('penilaian_vidio.pdf');
    }

    public function exportExcelVidio()
    {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::VIDIO->value)->first();

        // Data Putra
        $dataPenilaianVidio = PenilaianVidio::with('juri', 'pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->get()
            ->unique('pembina_id')
            ->map(function ($penilaian_vidio) {
                return [
                    'no' => $penilaian_vidio->id,
                    'nama_juri' => $penilaian_vidio->juri->nama,
                    'nama_pembina' => $penilaian_vidio->pembina->nama,
                    'pangkalan' => $penilaian_vidio->pembina->pangkalan,
                    'nilai_akhir' => $penilaian_vidio->total_nilai,
                    'rangking' => $penilaian_vidio->rangking,
                ];
            })->sortByDesc('nilai_akhir')->values()->toArray();

        return Excel::download(new PenilaianFotoExport($dataPenilaianVidio), 'penilaian_vidio.xlsx');
    }

}

class PenilaianFotoExport implements FromCollection, WithHeadings
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Juri',
            'Nama Pembina',
            'Pangkalan',
            'Nilai Akhir',
            'Rangking'
        ];
    }
}
