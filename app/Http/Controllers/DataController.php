<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\DataPenduduk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    
    // fungsi untuk menampilkan bagian index (data yang ada)
    public function index()
    {
        // kita ambil data yang ada dari Database lewat Models

        // Berhasil
        // cara pertama dengan menggunakan Model::all()
        // Gagal Menggunakan Fitur Pagination
        // variabelview digunakan diblade(pas foreach)
        // $data = DataPenduduk::all();
        // return view('admin.index')->with('variabelview', $data);


        // Berhasil
        // $data = DataPenduduk::orderBy('id','desc')->get();
        // return view('admin.index')->with('variabelview', $data);

        // Berhasil
        //  ->orderBy('id','desc'); =data diurutkan berdasarkan id secara desc(bawah ke atas)
        // $data = DB::table('data_penduduks')->orderBy('id', 'desc')->get();
        // return view('admin.index')->with('variabelview', $data); 

        // Berhasil
        //  $data => $variabelview
        // cara kedua dengan  DB::table('nama kolom')
        // Supoort Pagination,Pastikan diatas sudah use Illuminate\Support\Facades\DB;
        // variabelview digunakan diblade(pas foreach)
        $data = DB::table('data_penduduks')->Paginate(10);
        return view('admin.index')->with('variabelview', $data);


        // gagal
        // Cara kedua perluasan dari cara pertama
        // ->orderBy('id','desc'); =data diurutkan berdasarkan id secara desc(bawah ke atas)
        // $data=DataPenduduk::all()->orderBy('id','desc');
        // return view('admin.index')->with('variabelview', $data);
    }



    /**
     * Show the form for creating a new resource.
     */



    // menampilkan form untuk create
    public function create()
    {
        //
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // meniympan data dari fungsi create,
    public function store(Request $request)
    {
        // pake session flash agar jika ada yang kurang,data yang tadi udah dimasukin tetep tertampil
        Session::flash('nama',$request->nama);
        Session::flash('phone',$request->phone);
        Session::flash('alamat',$request->alamat);
        
        // Proses Validasi
        $request->validate([
            // required = harus diisi
            // numeric = harus angka
            'nama'=> 'required',
            'phone'=> 'required | numeric',
            'alamat'=> 'required',
            // mimes = ekstensi foto
            'foto' => 'required | mimes:jpg,bmp,png'
        ],[
            // bikin pesan custom 
            'nama.required' => 'Nama Wajib Di isi !!!',
            'phone.required' => 'No Telp Wajib Di isi !!!',
            'phone.numeric' => 'No Telp Wajib Berupa Angka !!!',
            'alamat.required' => 'Alamat Wajib Di isi !!!',
            'foto.required' => 'Silahkan Upload Foto !!!',
            'foto.mimes' => 'Foto Harus Berkestensi JPG,BMP,PNG !!!',
        ]);

        // Proses Foto Sedikit berbeda
        //  $minta_foto => $nama_foto
        // variabel $mintafoto = minta (file) dengan atribut name=foto
        $minta_foto = $request->file('foto');
        // proses memfilter file tadi harus berkstensi (jpg,png,bmp)
        $ekstensi_foto = $minta_foto->extension();
        // bikin nama foto sesuai tgl upload
        $nama_foto = date('ymdhis').".".$ekstensi_foto;
        // foto tadi disimpan di suatu folder didalam folder public
        $minta_foto->move(public_path('featured_image'),$nama_foto);

        // Proses mengcreate data
        DataPenduduk::create([
            'nama' => $request->input('nama'),
            'phone' => $request->input('phone'),
            'alamat' => $request->input('alamat'),
            'foto' => $nama_foto
        ]);
        // pesan = varibel yang nanti dipakai di pesan.blade dan dipakai di blade2 lain
        return redirect('/data')->with('pesan', 'Berhasil Menambahkan Data');




    }

    /**
     * Display the specified resource.
     */

    // Bagian show detail data
    public function show($id)
    {
        // :where('nama'  =>artinya nanti route akan di set menjadi data/nama
        // $data = DataPenduduk::where('nama', $id)->first();
        // gunakan id soale primary key jadi gaada data yang sama
        // jangan lupa sesuaikan di blade nya
        $data = DataPenduduk::where('id', $id)->first();
        return view('admin.show')->with('variabelview', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */


    //  sama persis kaya fungsi show,cuma ini bisa diedit datane
    public function edit(string $id)
    {
        //
        $data = DataPenduduk::where('id', $id)->first();
        return view('admin.edit')->with('variabelview', $data);
        
    }

    /**
     * Update the specified resource in storage.
     */

    // fungsi nya untuk menyimpan perubahaan data
    public function update(Request $request, string $id)
    {
        //
        // return 'sukses merubah data';

        // data gaboleh diedit jadi kosong
        // data2 yang harus diisi
        $request->validate([
            'nama' => 'required',
            'phone' => 'required | numeric',
            'alamat' => 'required',
            // mimes = ekstensi foto
            'foto' => 'required | mimes:jpg,bmp,png'
        ], [
            // bikin pesan custom
            'nama.required' => 'Nama Wajib Di isi !!!',
            'phone.required' => 'No Telp Wajib Di isi !!!',
            'phone.numeric' => 'No Telp Wajib Berupa Angka !!!',
            'alamat.required' => 'Alamat Wajib Di isi !!!',
            'foto.required' => 'Silahkan Upload Foto !!!',
            'foto.mimes' => 'Foto Harus Berkestensi JPG,BMP,PNG !!!',
        ]);

        // bikin variabel untuk menampung data hasil inputan (kecuali foto)
        // harus sama2 tampung data
        $tampung_data =[
            'nama' => $request->input('nama'),
            'phone' => $request->input('phone'),
            'alamat' => $request->input('alamat'),
            
        ];

        // proses mengupdate data foto
        if ($request->hasFile('foto')) {
            // proses meminta inputan
            $request->validate([
                // mimes = ekstensi foto
                'foto' => ' required | mimes:jpg,bmp,png,jpeg'

            ], [
                'foto.required' => "Foto Wajib Di isi yaa !!!",
                'foto.mimes' => "Dalam Ekstensi (PNG,JPG,HEIC)",
            ]);            
        
        //  $minta_foto => $nama_foto
        // variabel $mintafoto = minta (file) dengan atribut name=foto
        $minta_foto = $request->file('foto');
        // proses memfilter file tadi harus berkstensi (jpg,png,bmp)
        $ekstensi_foto = $minta_foto->extension();
        // bikin nama foto sesuai tgl upload
        $nama_foto = date('ymdhis').".".$ekstensi_foto;
        // foto tadi disimpan di suatu folder didalam folder public
        $minta_foto->move(public_path('featured_image'),$nama_foto);
        //   sudah terupload ke direktori

            // proses menghapus foto lama
            $foto_lama = DataPenduduk::where('id', $id)->first();
            File::delete(public_path('featured_image') . '/' . $foto_lama->foto);
            // harus sama2 tampung data
            $tampung_data['foto'] = $nama_foto;
        }

        // Models => Update =>dengan data yang di simpan oleh variabel $tampungdata
        // harus sama2 tampung data
        DataPenduduk::where('id',$id)->update($tampung_data);
        return redirect('/data')->with('pesan','Sukses Mengupdate Dataa !!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // agar jika didelete,foto yang ada di folder public juga ikut ke hapus
        //  variabel $tampungfoto mencari data berdasarkan id
        // harus sama2 tampung data
        $tampung_data = DataPenduduk::where('id', $id)->first();
        // ,lalu ketika udah ketemu maka akan didelete (mendelet nama file didalam direktori foto di publik)
        // harus sama2 tampung data
        File::delete(public_path('featured_image') . '/' . $tampung_data->foto);


        DataPenduduk::where('id', $id)->delete();
        return redirect('/data')->with('pesan', 'Berhasil MengHapus Data Penduduk');
    }
}
