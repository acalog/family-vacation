<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Services\FFMpeg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    private $ffmpeg;

    public function __construct() {
        $this->ffmpeg = new FFMpeg();
    }

    public function upload(Request $request)
    {
        // Retrieve the currently authenticated user...
        $user = Auth::user();
        foreach($request->file('uploadFile') as $file) {
            $filename = $file->getClientOriginalName();
            $tempPath = $file->storeAs('public/temp', $filename);

            $tempPath = storage_path('app/' . $tempPath);

            $metadata = FFMpeg::probe($tempPath);
            if (isset($metadata['width']) && isset($metadata['height'])) {
                $aspect_ratio = $this->ffmpeg->categorizeRatio($metadata['width'], $metadata['height']);
                $metadata['aspect_ratio'] = $aspect_ratio;
            } else {
                $metadata['aspect_ratio'] = '';
            }

            $attachment = Attachment::create([
                'filename' => $filename,
                'title' => $filename,
                'type' => $file->getClientOriginalExtension(),
                'owner' => $user->name,
                'width' => $metadata['width'] ?? 0,
                'height' => $metadata['height'] ?? 0,
                'aspect_ratio' => $metadata['aspect_ratio'] ?? '',
                'display_aspect_ratio' => $metadata['display_aspect_ratio'] ?? '',
            ]);
            $attachment->save();

            Storage::disk('lambda')->putFileAs('', $file, $file->getClientOriginalName());

            $deleted = Storage::delete('public/temp/' . $file->getClientOriginalName());
        }
        return redirect()->route('home');
    }
}
