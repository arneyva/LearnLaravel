<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // menampilkan form login
    function formlog(){
        return view('auth.login');
    }

    // proses login
    // mirip fungsi store
    function login(Request $request){
        // kasih sesiion
        // biar klo salah,data yang tadi di input ga hilang
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'Masukan Email Anda !!',
            'password.required' => 'Masukan Password Anda !!',
        ]);

         // proses authentikasi

        //  variabel penyimpan data
         $simpandata = [
            'email' => $request->email,
            'password' => $request->password,
         ];

         // 
        //  if(Auth::attempt => udah bawaan laravel
        if(Auth::attempt($simpandata)){
            // yang dijalankan jika ketika benar (othentikasi sukses)
            return redirect('data')->with('pesan', Auth::user()->name.'  Berhasil Login !!');

        }else{
            // kalau gagal
            //  return "gagal";
            return redirect('auth')->withErrors('Username/Password Anda Salah !!');
            
        }

        
    }

    // proses logout
    function logout(){
        Auth::logout();
        return redirect('auth')->with('pesan','Berhasil Logout');
    }

    // menampilkan form register
    function formregis(){
        return view('auth.register');
    }

    // proses register
    // kaya fungsi
    function register(Request $request){
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        Session::flash('password', $request->password);
        $request->validate([
            'name' => 'required',
            // unique = harus berbeda dari yang sudah ada di tabel users
            'email' => 'required | email | unique:users',
            'password' => 'required | min:6',
        ], [
            // bikin pesan custom
            'name.required' => "Masukan Nama Anda !!",
            'email.required' => "Masukan Email Anda !!",
            'email.email' => "Email Anda Tidak valid !!",
            'email.unique' => "Email Anda Sudah Digunakan !!",
            'password.required' => "Password Anda Salah !!",
            'password.min' => "Password Minimal 6 Karakter !!",
        ]);

        // proses menyimpan data
        $simpandata = [
            'name'=>  $request->input('name'),
            'email'=>  $request->input('email'),
            'password'=>  Hash::make ($request->password),
        ];

        // tabel::create(nilai dari variabel simpan data)
        User::create($simpandata);
        return redirect('auth')->with('pesan','Behasil Mendaftar,silahkan Login !!!');

        
    }
    
}
