<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    public function editTitle(Request $request) {

        $attachment = Attachment::find($request->id);

        $attachment->title = $request->title;

        $attachment->save();

        return $request->id;
    }

    public function delete(Request $request) {

        $attachment = Attachment::find($request->id);

        return view('content.image.delete')->with(['attachment' => $attachment]);
        
    }

    public function destroy(Request $request) {

        $attachment = Attachment::find($request->id);
        
        $attachment->delete();

        return redirect()->route('home')->with(['alert' => 'Attachment Deleted']);

    }
}
