<?php

namespace App\Http\Controllers;

use App\Models\DataPenduduk;
use Illuminate\Http\Request;

class UjiCoba extends Controller
{
    //Uji coba fungsi index yang menampilkan data tabel
    public function CobaIndex(){
        $data = DataPenduduk::all()->Pagi;
        return view('admin.index')->with('variabelview', $data);
    }
}
