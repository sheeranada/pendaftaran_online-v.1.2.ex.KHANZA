<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use App\Models\BookingPeriksa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class BookingPeriksaController extends Controller
{
    public function index()
    {
        $pasien = Pasien::all();
        $klinik = Poliklinik::all()->toArray();
        return view('app.form_daftar', compact('pasien', 'poliklinik'));
    }
    public function store(Request $request)
    {
        $lastBooking = BookingPeriksa::orderBy('tanggal_booking', 'desc')->first();

        $tgl = $request->tanggal;

        if ($lastBooking) {
            $lastBookingDate = substr($lastBooking->no_booking, 2, 8);
            $lastBookingNumber = substr($lastBooking->no_booking, 10);
            $todayDate = Carbon::parse($tgl)->format('Ymd');
            // $todayDate = date('Ymd');

            if ($lastBookingDate == $todayDate) {
                $newNumber = sprintf('%04d', intval($lastBookingNumber) + 1);
            } else {
                $newNumber = '0001';
            }
        } else {
            $newNumber = '0001';
            $todayDate = Carbon::parse($tgl)->format('Ymd');
            // $todayDate = date('Ymd');
        }

        $newBookingNumber = 'BP' . $todayDate . $newNumber;

        $validator = Validator::make($request->all(), [
            // 'no_booking' => 'required | string | min:3 | max:25',
            'tanggal' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) use ($request) {
                    $tanggalBooking = date_create_from_format('Y-m-d H:i:s', $request->tanggal_booking);
                    $tanggalInput = date_create_from_format('Y-m-d', $value);
                    if ($tanggalInput <= $tanggalBooking) {
                        $fail('Tanggal harus lebih besar dari tanggal booking: ' . $request->tanggal_booking);
                    }
                },
            ],
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'kd_poli' => 'required',
            'tambahan_pesan' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            $response = ['errors' => $validator->errors(), 'input' => $request->all()];
            return redirect()->back()->with('errors', $validator->messages()->all()[0])->withInput();
        }


        $booking = new BookingPeriksa();
        $booking->no_booking = $newBookingNumber;
        $booking->tanggal = $request->tanggal;
        $booking->nama = $request->nama;
        $booking->alamat = $request->alamat;
        $booking->no_telp = $request->no_telp;
        $booking->email = $request->email;
        $booking->kd_poli = $request->kd_poli;
        $booking->tambahan_pesan = $request->tambahan_pesan;
        $booking->status = $request->status;
        $booking->tanggal_booking = date('Y-m-d H:i:s');
        $booking->save();

        $bookings = BookingPeriksa::all();
        return redirect()->route('status', ['bookings' => $bookings])->withSuccess('Berhasil mendaftar!');

    }

    public function status(Request $request)
    {
        $bookings = $request->query('bookings');
        dd($bookings);
        return view('status', ['bookings' => $bookings]);
    }

    public function getHari()
    {
        $date = now();
        $hari = Carbon::parse($date)->format('N');
        switch ($hari) {
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
        return $nama_hari;
    }

    public function getDokterByTanggal(Request $request)
    {
        $tgl_registrasi = $request->tgl_registrasi;
        $dokter = Dokter::where('tgl_registrasi', $tgl_registrasi)->first();

        return response()->json([
            'nm_dokter' => $dokter->nm_dokter
        ]);
    }

}