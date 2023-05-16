<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Pasien;
use App\Models\Poliklinik;
use App\Models\RegPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


date_default_timezone_set('Asia/Jakarta');
class PasienController extends Controller
{
    public function index()
    {
        $pasien = Pasien::paginate(5);
        // dd($klinik);
        return view('app.index', compact('pasien'));
    }
    public function cekPasien(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rkm_medis' => 'required|min:3',
            'tgl_lahir' => 'required|min:3'
        ]);

        if ($validator->fails()) {
            return back()->with('errors', $validator->messages()->all()[0])->withInput();
        }

        $no_rkm_medis = $request->input('no_rkm_medis');
        $tgl_lahir = $request->input('tgl_lahir');
        $umur = $request->input('umur');

        $poliklinik = Poliklinik::all();
        $jadwal = Jadwal::all();

        $pasien = Pasien::where('no_rkm_medis', $no_rkm_medis)
            ->where('tgl_lahir', $tgl_lahir)
            ->first();

        // dd($request);
        if ($pasien) {
            return view('app.form_daftar', compact('pasien', 'poliklinik', 'jadwal'));
        } else {
            return redirect()->back()->with('error', 'Data pasien tidak ditemukan !');
        }
    }

    // public function getDokter(Request $request)
    // {
    //     $poliklinik = Poliklinik::all();
    //     $jadwal = Jadwal::all();
    //     $dokter = Dokter::all();

    //     $tanggal = $request->input('tanggal');
    //     $hari = Carbon::createFromFormat('Y-m-d', $tanggal)->format('l');
    //     $hari = str_replace(
    //         array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'),
    //         array('SENIN', 'SELASA', 'RABU', 'KAMIS', 'JUMAT', 'SABTU', 'MINGGU'),
    //         $hari
    //     );
    //     // $tgl_registrasi = now()->format('Y-m-d');
    //     $jam_reg = now()->format('H:i:s');
    //     $kd_poli = $request->input('kd_poli');
    //     $jadwal = Jadwal::where('hari_kerja', $hari)
    //         ->where('kd_poli', $kd_poli)
    //         ->pluck('kd_dokter');

    // }
    public function getDaftar(Request $request)
    {


        // $tanggal = date("Y/m/d", strtotime($request->tgl_registrasi));
        $tanggal = $request->input('tgl_registrasi');

        $jam_terakhir = RegPeriksa::where('tgl_registrasi', $tanggal)
            ->orderby('jam_reg', 'desc')
            ->pluck('jam_reg')
            ->first();
        ; // Get the last jam_reg in the database

        // Get the last registration for the given date and time
        $last_reg = RegPeriksa::where('tgl_registrasi', $tanggal)
            // $last_reg = RegPeriksa::where('tgl_registrasi', $request->tgl_registrasi)
            // ->where('jam_reg', '<=', now()->format('H:i:s'))
            ->where('jam_reg', '<=', $jam_terakhir)
            ->orderBy('jam_reg', 'desc')
            ->first();

        $no_rawat = 1;

        // If there is a last registration, get the last number of the no_rawat field
        // and increment it by 1. Otherwise, set it to 1.
        if ($last_reg) {
            $last_no_rawat = substr($last_reg->no_rawat, -6);
            $no_rawat = intval($last_no_rawat) + 1;
        }

        // Format the number with leading zeroes and concatenate it with the date
        $no_rawat_formatted = str_pad($no_rawat, 6, "0", STR_PAD_LEFT);
        $no_rawat_with_date = "$tanggal/$no_rawat_formatted";

        // If the date has changed, reset the number to 1
        if ($last_reg && $last_reg->tgl_registrasi != $request->tgl_registrasi) {
            $no_rawat_with_date = "$tanggal/000001";
        }

        // no registrasi
        $kd_poli = $request->input('kd_poli');
        // penambahan by dokter
        $kd_dokter = $request->input('kd_dokter');

        // Count the number of kd_poli for the given date
        $num_kd_poli = RegPeriksa::where('tgl_registrasi', $request->tgl_registrasi)
            ->where('kd_poli', $kd_poli)
            ->where('kd_dokter', $kd_dokter)
            ->count();

        // Format the number with leading zeroes
        $no_reg = str_pad($num_kd_poli + 1, 3, '0', STR_PAD_LEFT);


        // Validate kd_pj == BPJ
        // $kd_pj = $request->kd_pj;
        // if ($kd_pj == 'BPJ') {
        //     $last_reg_bpj = RegPeriksa::where('tgl_registrasi', $request->tgl_registrasi)
        //         ->where('kd_pj', 'BPJ')
        //         ->where('no_rkm_medis', $request->no_rkm_medis)
        //         ->count();
        //     if ($last_reg_bpj > 0) {
        //         // return response(['message' => 'BPJ hanya dapat submit 1x dalam sehari'], 422);
        //         return redirect('/')->with('errors', 'Pendaftaran gagal !, kuota akun BPJS anda telah habis / anda sudah terdaftar hari ini. silahkan mencoba metode pembayaran lain.');
        //         // alert()->warning('Pendaftaran gagal !', 'kuota akun BPJS anda telah habis / anda sudah terdaftar hari ini.')->persistent(true, false);
        //     }
        // }


        // Check if the given no_rkm_medis has already registered on the requested date
        $num_no_rkm_medis = RegPeriksa::where('tgl_registrasi', $tanggal)
            ->where('no_rkm_medis', $request->no_rkm_medis)
            ->count();

        // If the given no_rkm_medis has already registered on the requested date, return an error message
        if ($num_no_rkm_medis > 0) {
            return redirect('/')->with('errors', 'Pendaftaran gagal !, Anda sudah terdaftar hari ini. Silakan mencoba dengan tanggal dan waktu yang berbeda.');
        }


        $reg_periksa = new RegPeriksa();
        $umur_array = explode(' ', $request->umur);
        $reg_periksa->umurdaftar = $umur_array[0];
        $reg_periksa->tgl_registrasi = $request->tgl_registrasi;
        $reg_periksa->kd_dokter = $request->kd_dokter;
        $reg_periksa->kd_poli = $request->kd_poli;
        $reg_periksa->no_rkm_medis = $request->no_rkm_medis;
        $reg_periksa->stts = 'Belum';
        $reg_periksa->stts_daftar = 'Lama';
        $reg_periksa->status_lanjut = 'Ralan';
        $reg_periksa->status_bayar = 'Belum Bayar';
        $reg_periksa->status_poli = 'Baru';
        $reg_periksa->sttsumur = 'Th';
        $reg_periksa->p_jawab = '-';
        $reg_periksa->almt_pj = '-';
        $reg_periksa->hubunganpj = '-';
        $reg_periksa->jam_reg = now()->format('H:i:s');
        $reg_periksa->no_rawat = $no_rawat_with_date;
        $reg_periksa->kd_pj = $request->kd_pj;
        $reg_periksa->biaya_reg = 0;
        $reg_periksa->no_reg = $no_reg;
        // return redirect()->route('result')->withSuccess('Pendaftaran berhasil !');
        return view('app.result', compact('reg_periksa'));
        // return $no_rawat_with_date;
        // return response()->json($reg_periksa);


    }

    public function result(Request $request)
    {
        $dokter = Dokter::all();
        $reg_periksa = new RegPeriksa();
        $reg_periksa->no_reg = $request->no_reg;
        $reg_periksa->no_rawat = $request->no_rawat;
        $reg_periksa->tgl_registrasi = $request->tgl_registrasi;
        $reg_periksa->jam_reg = $request->jam_reg;
        $reg_periksa->kd_dokter = $request->kd_dokter;
        $reg_periksa->no_rkm_medis = $request->no_rkm_medis;
        $reg_periksa->kd_poli = $request->kd_poli;
        $reg_periksa->p_jawab = $request->p_jawab;
        $reg_periksa->almt_pj = $request->almt_pj;
        $reg_periksa->hubunganpj = $request->hubunganpj;
        $reg_periksa->biaya_reg = $request->biaya_reg;
        $reg_periksa->stts = $request->stts;
        $reg_periksa->stts_daftar = $request->stts_daftar;
        $reg_periksa->status_lanjut = $request->status_lanjut;
        $reg_periksa->kd_pj = $request->kd_pj;
        $reg_periksa->umurdaftar = $request->umurdaftar;
        $reg_periksa->sttsumur = $request->sttsumur;
        $reg_periksa->status_bayar = $request->status_bayar;
        $reg_periksa->status_poli = $request->status_poli;
        $reg_periksa->save();
        return redirect('/')->withSuccess('Pendaftaran berhasil !');
        // // return $reg_periksa;


    }



}