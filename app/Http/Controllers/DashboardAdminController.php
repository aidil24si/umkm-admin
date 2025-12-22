<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use App\Models\Proyek;
use Illuminate\Http\Request;
use App\Models\TahapanProyek;
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
        $data['dataUser'] = User::all();

        // Hitung total anggaran
        $data['totalAnggaran'] = Proyek::sum('anggaran');

        if (!Auth::check()) {
		       //Redirect ke halaman dashboard
               return redirect()->route('login');
		    }
		    //Redirect ke halaman login
        return view('pages.dashboard', $data);
    }
}
