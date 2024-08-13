<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\PasswordChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    // Login
    public function login_proses(Request $request)
    {
        Session::flash("email", $request->email);
        Session::flash("password", $request->password);
        // dd($request->all());
        $request->validate([
            "email" => "required|email",
            "password" => "required",
        ],[
            "email.required"=> "Isi emailnya dulu",
            "password.required"=> "Isi passwordnya dulu",
        ]);

        $infologin = [
            "email"=> $request->email,
            "password"=> $request->password,
        ];

       if(Auth::attempt($infologin)){
        // Autentikasi berhasil
        // Session::flash("success-login", "Berhasil Login");
            return redirect()->route("dashboard")->with("success-login"," Kamu berhasil login");
       }else{
        // Autentikasi gagal
        return redirect()->route("login")->with("failed","Email atau password salah");
       }

    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        // Session::flash("success-logout","Berhasil logout");
        return redirect()->route("login")->with("success","Kamu berhasil logout");
    }

    public function register()
    {
        return view("auth.register");
    }

    // Regsiter
    public function register_proses(Request $request)
    {
            // dd($request->all());
        $request->validate([
            "nama" => 'required',
            'email' => 'required|email|unique:users,email,',
            'password' => 'required|min:6'
        ],[
            "nama.required" =>  "isi namanya dulu",
            "email.required" => "Isi emailnya dulu",
            "email.unique" => "Silahkan gunakan email yang lain",
            "password.required" => "Isi passwordnya dulu",
            "password.min"=> "Isi password dengan 6 karakter",
        ]
    );


        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        $login = [
            "email"=> $request->email,
            "password"=> $request->password,
        ];

       if(Auth::attempt($login)){
        // Autentikasi berhasil
        Session::flash("success-register", "Berhasil masuk");
        // jika diarahkan ke dashboard/admin itu tidak logis maka harus diarahkan ke route login untuk langsung ditest input email beserta passwordnya
        return redirect()->route("dashboard");
       }else{
        // Autentikasi gagal
        return redirect()->route("login")->with("failed","Email atau password salah");
       }

    }
    public function showChangePasswordForm()
    {
        return view('auth.gantipassword');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'new_password' => 'required|string|min:6|confirmed',
            'new_password_confirmation' => 'required'
        ], [
            'email.required' => 'Masukkan alamat email',
            'email.email' => 'Masukkan alamat email yang valid',
            'new_password.required' => 'Masukkan password baru',
            'new_password.min' => 'Password baru minimal 6 karakter',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok',
            'new_password_confirmation.required' => 'Konfirmasi password baru diperlukan'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diubah');
    }

}