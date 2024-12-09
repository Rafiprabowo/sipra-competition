namespace App\Http\Controllers;

use App\Models\Finalisasi;
use App\Models\Pembina;
use App\Models\Regu;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrasiController extends Controller
{
    /**
     * Menampilkan halaman form registrasi
     */
    public function index()
    {
        $pembina = Auth::user()->pembina;
        $finalisasi = Finalisasi::where('pembina_id', $pembina->id)->first();

        if ($finalisasi && $finalisasi->status_finalisasi) {
            return redirect()->route('registrasi.view');
        }

        return view('registrasi.form', compact('pembina', 'finalisasi'));
    }

    /**
     * Menangani finalisasi pendaftaran
     */
    public function finalisasi(Request $request)
    {
        $pembina = Auth::user()->pembina;

        // Cek apakah data pembina sudah terisi
        if (!$pembina) {
            return redirect()->route('registrasi.form')->with('error', 'Data pembina belum lengkap.');
        }

        // Cek apakah jumlah regu sudah terpenuhi
        $regus = Regu::where('pembina_id', $pembina->id)->get();
        if ($regus->count() < 2) {
            return redirect()->route('registrasi.form')->with('error', 'Jumlah regu minimal adalah 2.');
        }

        // Cek apakah setiap regu memiliki 8 peserta dan setiap kategori ada
        foreach ($regus as $regu) {
            $pesertaL = $regu->peserta()->where('kategori', 'L')->count();
            $pesertaP = $regu->peserta()->where('kategori', 'P')->count();
            if ($pesertaL < 8 || $pesertaP < 8) {
                return redirect()->route('registrasi.form')->with('error', 'Setiap regu harus memiliki minimal 8 peserta laki-laki dan perempuan.');
            }
        }

        // Finalisasi pendaftaran
        Finalisasi::updateOrCreate(
            [
                'pembina_id' => $pembina->id,
            ],
            [
                'status_finalisasi' => 1,
                'keterangan' => $request->keterangan,
            ]
        );

        return redirect()->route('registrasi.view')->with('success', 'Pendaftaran berhasil difinalisasi.');
    }

    /**
     * Menampilkan halaman view setelah finalisasi
     */
    public function view()
    {
        $pembina = Auth::user()->pembina;
        $finalisasi = Finalisasi::where('pembina_id', $pembina->id)->first();

        return view('registrasi.view', compact('pembina', 'finalisasi'));
    }
}
