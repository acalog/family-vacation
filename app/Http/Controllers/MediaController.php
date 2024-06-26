<?php

namespace App\Http\Controllers;

use App\Models\Metadata;
use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Services\FFMpeg;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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

            $thumbnailPath = storage_path('app/public/temp/thumbnail/') . $filename;

            $exif = exif_read_data($tempPath);

            $orientation = $exif['Orientation'];
            $orientation = $exif['Orientation'] == 6 ? 'portrait' : 'landscape';
            $width = $exif['Orientation'] == 6 ? $exif['ImageLength'] : $exif['ImageWidth'];
            $height = $exif['Orientation'] == 6 ? $exif['ImageWidth'] : $exif['ImageLength'];
            FFMpeg::thumbnail($tempPath, $thumbnailPath, $width, $height);

            $aspect_ratio = $this->ffmpeg->categorizeRatio($width, $height);

            $attachment = Attachment::create([
                'filename' => $filename,
                'title' => $filename,
                'type' => $file->getClientOriginalExtension(),
                'owner' => $user->name,
                'width' => $width ?? 0,
                'height' => $height ?? 0,
                'aspect_ratio' => $aspect_ratio ?? '',
                'display_aspect_ratio' => '',
            ]);
            $attachment->save();

            Storage::disk('s3')->putFileAs('', $file, $file->getClientOriginalName());

            $thumbnail = File::get($thumbnailPath);

            Storage::disk('s3')->put('thumbnails/' . $filename, $thumbnail);

            Storage::delete('public/temp/thumbnail/' . $file->getClientOriginalName());
            $deleted = Storage::delete('public/temp/' . $file->getClientOriginalName());
        }
        return redirect()->route('home');
    }
}
