<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function LoginForm()
    {
        return view('superadmin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username'    => 'required|username',
            'password' => 'required',
        ]);

    if (
            $request->username === env('SUPERADMIN_USERNAME') &&
            $request->password === env('SUPERADMIN_PASSWORD')
        ) {
            // store in session manually
            session(['superadmin_logged_in' => true]);

            return redirect()->route('super_admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid superadmin credentials',
        ]);
    }

}
