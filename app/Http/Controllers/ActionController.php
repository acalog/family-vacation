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
            $columns = array_fill(0, 4, []);
            foreach ($images as $index => $image) {
                $column_index = $index % 4;
                $columns[$column_index][] = $image;
            }

            return view('content.home')->with(['images' => $images, 'columns' => $columns]);
        }
        else {
            return view('welcome');
        }
    }
}