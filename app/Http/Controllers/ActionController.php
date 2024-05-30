<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{
    public function home (Request $request) {
        if (Auth::check()) {
            $images = Attachment::all();
            
            return view('content.home')->with(['images' => $images]);
        }
        else {
            return view('welcome');
        }
    }
}