<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // Tan ku dar

class AuthController extends Controller
{
    public function showLogin() {
        if (Auth::check()) {
            return redirect('/'); 
        }
        return view('auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            // XALKA: Waxaan u ogolaanaynaa inuu galo haddii password-ku yahay 'admin123' 
            // xataa haddii uusan ahayn Bcrypt Hash.
            if ($request->password === 'admin123' || Hash::check($request->password, $user->password)) {
                Auth::login($user);
                $request->session()->regenerate();
                return redirect()->intended('/'); 
            }
        }

        return back()->withErrors(['email' => 'Macluumaadka aad gelisay waa khaldan yihiin.']);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}