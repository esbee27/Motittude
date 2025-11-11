<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;


class AdvertController extends Controller
{
    //
    public function showVideo() 
    {
        $videos = Video::all();
        $advert = Video::latest()->first();

        return view('user.show_video', compact('videos'));
    }

    public function videoForm()
    {
        return view('user.advert.videoForm');
    }

public function storeVideo(Request $request)
{
   // dd('hit'); 

    // Validate request
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'video' => 'required|mimes:mp4,webm,ogg|max:51200', // max 50MB
    ]);

    // Store file in storage/app/public/videos
    $data['path'] = $request->file('video')->store('videos', 'public');

    // Save in DB
    Video::create($data);

    // Redirect to video list instead of login
    return redirect()->route('user.showVideo')
                     ->with('success', 'You have added a new video successfully.');
}


}
