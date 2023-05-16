<?php

namespace App\Http\Controllers;

use App\Models\RegPeriksa;
use Illuminate\Http\Request;

class RegPeriksaController extends Controller
{
    public function getDaftar()
    {
        $reg_periksa = RegPeriksa::where('no_rawat', "2023/04/06/000001")->get();
        return response()->json($reg_periksa);
    }
}