<?php

namespace App\Http\Controllers\Super_admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //
    public function create () 
    {
        return view('superadmin.school.create'); 
    }

    public function store (Request $request) 
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string'
        ]);

        School::create([
            'name' => $request->name,
            'email' => $request->email,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->back()->with('success', 'School added successfully!');
    }

    /*public function show () 
    {
        return view('user.quizzes');
    }
        */
}
