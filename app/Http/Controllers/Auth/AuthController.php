<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Models\User;
use App\Event\NewUserRegistered;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{

    public function index()
    {
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return match (Auth::user()->role) {
                'admin' => redirect('/admin')->with('success', 'Berhasil Login'),
                'developer' => redirect('/developer/dashboard')->with('success', 'Berhasil Login'),
                'agent' => redirect('/agent/dashboard')->with('success', 'Berhasil Login'),
                default => redirect(route('beranda'))->with('success', 'Berhasil Login'),
            };
        }

        return redirect('/login')->with('error', 'Email atau password salah');
    }

    public function register(Request $request)
    {
        Session::flash('name', $request->name);
        session::flash('email', $request->email);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' =>  'required|min:6'
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        event(new UserRegistered($request->name));

        return match (Auth::user()->role) {
            'admin' => redirect('/admin')->with('success', 'Berhasil Login'),
            'developer' => redirect('/developer/dashboard')->with('success', 'Berhasil Login'),
            'agent' => redirect('/agent/dashboard')->with('success', 'Berhasil Login'),
            default => redirect(route('beranda'))->with('success', 'Berhasil Login'),
        };
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
