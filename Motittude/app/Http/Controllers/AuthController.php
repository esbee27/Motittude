<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function signup(Request $request) {
        //Signup page
        if ($request->isMethod('post')) {
            $data = $request->validate([
            'username' => 'required|string|max:100|unique:users,username',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email',
            'gender' => ['string'],
            'date_of_birth' => 'string',
            'phone_no' => 'string',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        auth()->login($user);
        return redirect('/login');
        } else {
            return view('signup');
        }
    }

    /**
     * Show the form for creating a new resource.
     */

    public function login(Request $request)
    {
        //Login page
        if ($request->isMethod('post')) {
            $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
            if (Auth::attempt($data)) {
                $request->session()->regenerate();
                return redirect('/');
            }
            return redirect('/login');
        } else {
            return view('login');
        }
    }



    public function logout()
    {
        session()->flush();
        
        return redirect()->route('login')->with('success', 'You have logged out successfully.');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function profile(Request $request)
    {
        //Dashboard

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}

