<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Poliklinik;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::all();
        $poliklinik = Poliklinik::all();
        return view('jadwal.index', compact('dokter', 'poliklinik'));
    }

    public function getJadwal(Request $request)
    {
        $jadwal = Jadwal::where('kd_poli', $request->kd_poli)->where('hari_kerja', $request->hari_kerja)
            ->orderBy('kd_dokter')
            ->get();
        return response()->json(['status' => true, 'data' => $jadwal]);
    }
    public function pilihDokter(Request $request)
    {
        $tanggal = $request->tanggal;
        //
        $kd_poli = $request->kd_poli;
        //
        // $indexHari = array_search($tanggal, ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"]);
        $indexHari = Carbon::parse($tanggal)->format('N');
        switch ($indexHari) {
            case 1:
                $nama_hari = 'Senin';
                break;
            case 2:
                $nama_hari = 'Selasa';
                break;
            case 3:
                $nama_hari = 'Rabu';
                break;
            case 4:
                $nama_hari = 'Kamis';
                break;
            case 5:
                $nama_hari = 'Jumat';
                break;
            case 6:
                $nama_hari = 'Sabtu';
                break;
            case 7:
                $nama_hari = 'Minggu';
                break;
            default:
                $nama_hari = 'Hari tidak valid';
                break;
        }
        $jadwal = Jadwal::where('hari_kerja', $nama_hari)
            ->where('kd_poli', $kd_poli)
            ->get();
        $dokterIds = $jadwal->pluck('kd_dokter')->unique();
        $dokters = Dokter::whereIn('kd_dokter', $dokterIds)->get();
        return response()->json($dokters);
        // return $nama_hari;
    }
    public function pilihPoli()
    {
        $poliklinik = Poliklinik::all();
        return response()->json($poliklinik);
    }

}