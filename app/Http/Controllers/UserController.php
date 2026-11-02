<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use App\Models\SubscriptionPackage;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
        public function register(Request $request)
        {

        $validateData = $request->validate([
            // validasi
            // 'nama_input' => ['jenis validasi']
            // required = wajib diisi
            // minimal karakter min:3
            'name' => ['required', 'min:3'],
            //unique:user,field: data email tidak boleh duplikat
            'email' =>['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:10']
        ], [
            // teks err yang bakal muncul kalau validasi gagal
            // 'nama_input.jenis_validasi' => 'pesan'
            'name.required' => 'Nama lengkap harus diisi',
            'name.min' => 'Nama lengkap harus diisi minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email harus diisi dengan data yang belum terdaftar',
            'password.required' => 'Password Harus diisi',
            'password.min' => 'Password harus diisi minimal 8 karakter',
            'password.max' => 'Password harus diisi hanya sampai 10 karakter',
        ]);

        // simpan data ke database : model
        $createAccount = User::create([
            //nama_field => isi data
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            // hash : make => mengubah PW plain text menjadi karakter acak yang tidak bisa dibaca/dikenalkan ke text aslinya
            'password' => Hash::Make($validateData['password'])
            // 'role => 'user
        ]);

        // menentukan jika berhasil disimpan akan diarahkan ke halaman nama : return redirect()->route()
        // mengirimkan session untuk notifikasi/info berhasil : with('nama', 'pesan')
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat. Silahkan login!');
    }

    public function login(Request $request)
    {
        $validateData = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $data =[
            "email"=>$validateData['email'],
            "password"=>$validateData['password'],
        ];
        // Auth::attempt(): memerlukan data user/email dan pw yang sudah di hashting
        // 1. cek pw yang sudah di hashing apakah sesuai dengan pw yang sudah di input
        // 2. mencocokan username/email dan pw dsb
        // 3. kalau cocok data penggunanya disimpan di session/cookies
        if(Auth::attempt($data)){
            // regenerate idsession after login berhasil
            $request->session()->regenerate();

            // Auth user() : mengambil data user yang sedang login
            if(Auth::User()->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
            } else {
                 // jika berhasil login, maka akan di arahkan kemana
                return redirect()->route('home')->with('success', 'Berhasil Login!');
            }
           
        }else{
            // jika gagal login. diarahkan kemana
           return redirect()->route('login')->with('error', 'Email dan password tidak sesuai. Silahkan coba lagi!');  
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('success', 'Anda telah logout!');
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        // LIKE : mencari data yang mirip/mengandung kata yang dicari. % didepan untuk mencari kata yang di belakangnya ada huruf/kalimat...., % dibelakang untuk mencari kata yang di didepannya ada huruf/kalimat... 
        // orWhere : mencari data pada field lain
        $books = Book::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('writer', 'LIKE', '%' . $query . '%')
            ->get();
        return view('search_results', compact('books', 'query'));
    }

    public function category(Request $request, BookCategory $bookCategory)
    {
        $query = $request->input('search');
        $sort  = $request->input('sort');

        $books = $bookCategory->books()
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', '%' . $query . '%')
                ->orWhere('writer', 'LIKE', '%' . $query . '%');
        });

        if ($sort == 'termurah') {
            $books = $books->orderBy('price', 'asc');
        } elseif ($sort == 'termahal') {
            $books = $books->orderBy('price', 'desc');
        } else {
            $books = $books->latest();
        }

        $books = $books->get();

        return view('category', compact('bookCategory', 'books', 'query'));
    }
}