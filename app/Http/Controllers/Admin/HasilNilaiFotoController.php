<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PenilaianFoto;
use App\Models\MataLomba;
use Maatwebsite\Excel\Facades\Excel; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PesertaExport; 
use PDF;
use Illuminate\Support\Facades\DB;

class HasilNilaiFotoController extends Controller
{
    public function index()
    {
        // Ambil mata lomba
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::FOTO->value)->first();

        if (!$mata_lomba) {
            return redirect()->route('admin.dashboard')->with('error', 'Mohon maaf, masukkan mata lomba Foto untuk membuka penilaian.');
        }

        // Ambil penilaian foto dengan relasi dan filter duplikat berdasarkan pembina_id
        $penilaianFotos = PenilaianFoto::with('juri', 'pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->get()
            ->unique('pembina_id')
            ->sortByDesc('total_nilai')->values();

        // Assign rankings and update the database
        $penilaianFotos->each(function ($penilaian_foto, $index) {
            if ($index == 0) {
                $rank = 'Juara 1';
            } elseif ($index == 1) {
                $rank = 'Juara 2';
            } elseif ($index == 2) {
                $rank = 'Juara 3';
            } else {
                $rank = null;
            }
            $penilaian_foto->update(['rangking' => $rank]);
        });

        return view('admin.hasil_nilai.nilai_foto', compact('penilaianFotos'));
    }      

    public function exportPDFFoto(Request $request)
    {
        $tab = 'penilaian_foto';

        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::FOTO->value)->first();
        
        $penilaianFotos = PenilaianFoto::with('juri', 'pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->get()
            ->unique('pembina_id')
            ->sortByDesc('total_nilai')->values();

        $data = compact('penilaianFotos', 'mata_lomba', 'tab');
        
        $pdf = PDF::loadView('admin.hasil_nilai.template', $data)->setPaper('a4', 'portrait');
        return $pdf->download('penilaian_foto.pdf');
    }

    public function exportExcelFoto()
    {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::FOTO->value)->first();

        // Data Putra
        $dataPenilaianFoto = PenilaianFoto::with('juri', 'pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->get()
            ->unique('pembina_id')
            ->map(function ($penilaian_foto) {
                return [
                    'no' => $penilaian_foto->id,
                    'nama_juri' => $penilaian_foto->juri->nama,
                    'nama_pembina' => $penilaian_foto->pembina->nama,
                    'pangkalan' => $penilaian_foto->pembina->pangkalan,
                    'nilai_akhir' => $penilaian_foto->total_nilai,
                    'rangking' => $penilaian_foto->rangking,
                ];
            })->sortByDesc('nilai_akhir')->values()->toArray();

        return Excel::download(new PenilaianFotoExport($dataPenilaianFoto), 'penilaian_foto.xlsx');
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
