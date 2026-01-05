<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\Proyek;
use App\Models\Kontraktor;
use App\Models\LokasiProyek;
use Illuminate\Http\Request;
use App\Models\ProgresProyek;
use App\Models\TahapanProyek;
use App\Models\ViewWargaDashboard;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataTahapan'] = TahapanProyek::all();
        $data['dataWarga'] = Warga::all();
        $data['dataProyek'] = Proyek::all();
        $data['dataLokasi'] = LokasiProyek::all();
        $data['dataProgres'] = ProgresProyek::all();
        $data['dataKontraktor'] = Kontraktor::all();
        $data['dataUser'] = User::all();

        // Hitung total anggaran
        $data['totalAnggaran'] = Proyek::sum('anggaran');

        $data['jumlahWarga'] = Warga::count();
        $data['jumlahProyek'] = Proyek::count();
        $data['jumlahLokasi'] = LokasiProyek::count();
        $data['jumlahKontraktor'] = Kontraktor::count();

        if (!Auth::check()) {
		       //Redirect ke halaman dashboard
               return redirect()->route('login');
		    }
		    //Redirect ke halaman login
        return view('pages.dashboard', $data);
    }
}
