<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function upload(Request $request) 
    {
        // Retrieve the currently authenticated user...
        $user = Auth::user();
        foreach($request->file('uploadFile') as $file) {
            $attachment = Attachment::create([
                'filename' => $file->getClientOriginalName(),
                'title' => $file->getClientOriginalName(),
                'type' => $file->getClientOriginalExtension(),
                'owner' => $user->name
            ]);
            $attachment->save();
            Storage::disk('s3')->putFileAs('', $file, $file->getClientOriginalName());
        }
        return redirect()->route('home');
    }
}
