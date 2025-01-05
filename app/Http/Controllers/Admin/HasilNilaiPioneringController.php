<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\MataLomba;
use Maatwebsite\Excel\Facades\Excel; 
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PesertaExport; 
use PDF;
use Illuminate\Support\Facades\DB;

class HasilNilaiPioneringController extends Controller
{
    public function index() {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::PIONERING->value)->first();
    
        if (!$mata_lomba) {
            return redirect()->route('admin.dashboard')->with('error', 'Mohon maaf, masukkan mata lomba Pionering untuk membuka penilaian.');
        }

        // Fetch and process participants by gender
        $putra = Peserta::with('penilaian_pionering')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putra')
            ->whereHas('penilaian_pionering')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_pionering->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();
    
        $putri = Peserta::with('penilaian_pionering')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putri')
            ->whereHas('penilaian_pionering')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_pionering->total_nilai;
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
            $peserta->penilaian_pionering->update(['rangking' => $rank]);
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
            $peserta->penilaian_pionering->update(['rangking' => $rank]);
        });
    
        return view('admin.hasil_nilai.nilai_pionering', compact('putra', 'putri'));
    }      

    public function uploadTemplate(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'template' => 'required|file|mimes:pdf|max:2048',  // Maksimal 2MB untuk file
        ]);

        // Simpan file template PDF
        $filePath = $request->file('template')->store('templates');

        // Simpan path file ke dalam session atau database
        session(['template_pdf' => $filePath]);

        return redirect()->back()->with('success', 'Template PDF berhasil diunggah.');
    }

    public function exportPDF(Request $request)
    {
        // Ambil path template dari session atau database
        $templatePath = session('template_pdf');

        if (!$templatePath) {
            return redirect()->back()->with('error', 'Template PDF belum diunggah.');
        }

        $tab = $request->input('tab');

        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::PIONERING->value)->first();
        
        $putra = Peserta::with('penilaian_pionering', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putra')
            ->whereHas('penilaian_pionering')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_pionering->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();
        
        $putri = Peserta::with('penilaian_pionering', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putri')
            ->whereHas('penilaian_pionering')
            ->get()
            ->map(function ($peserta) {
                $peserta->highest_total_nilai = $peserta->penilaian_pionering->total_nilai;
                return $peserta;
            })->sortByDesc('highest_total_nilai')->values();

        $data = compact('putra', 'putri', 'tab', 'mata_lomba');
        
        $pdf = PDF::loadView('admin.hasil_nilai.template', $data)->setPaper('a4', 'portrait');
        return $pdf->download('penilaian_pionering.pdf');
    }

    public function exportExcel()
    {
        $mata_lomba = MataLomba::where('nama', \App\Enums\MataLomba::PIONERING->value)->first();

        // Data Putra
        $dataPutra = Peserta::with('penilaian_pionering', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putra')
            ->whereHas('penilaian_pionering')
            ->get()
            ->map(function ($peserta) {
                return [
                    'no' => $peserta->id,
                    'nama' => $peserta->nama,
                    'nama_regu' => $peserta->regu_pembina->nama_regu,
                    'pangkalan' => $peserta->regu_pembina->pembina->pangkalan,
                    'jenis_kelamin' => $peserta->jenis_kelamin,
                    'nilai_akhir' => $peserta->penilaian_pionering->total_nilai,
                    'rangking' => $peserta->penilaian_pionering->rangking,
                ];
            })->sortByDesc('nilai_akhir')->values()->toArray();

        // Data Putri
        $dataPutri = Peserta::with('penilaian_pionering', 'regu_pembina.pembina')
            ->where('mata_lomba_id', $mata_lomba->id)
            ->where('jenis_kelamin', 'Putri')
            ->whereHas('penilaian_pionering')
            ->get()
            ->map(function ($peserta) {
                return [
                    'no' => $peserta->id,
                    'nama' => $peserta->nama,
                    'nama_regu' => $peserta->regu_pembina->nama_regu,
                    'pangkalan' => $peserta->regu_pembina->pembina->pangkalan,
                    'jenis_kelamin' => $peserta->jenis_kelamin,
                    'nilai_akhir' => $peserta->penilaian_pionering->total_nilai,
                    'rangking' => $peserta->penilaian_pionering->rangking,
                ];
            })->sortByDesc('nilai_akhir')->values()->toArray();

        $sheets = [
            new PenilaianPioneringSheet($dataPutra, 'Putra'),
            new PenilaianPioneringSheet($dataPutri, 'Putri')
        ];

        return Excel::download(new MultipleSheetsExport($sheets), 'penilaian_pionering.xlsx');
    }
}

class PenilaianPioneringSheet implements FromCollection, WithHeadings
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


