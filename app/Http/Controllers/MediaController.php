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

            // Store image on local disk temporarily.
            $tempPath = $file->storeAs('public/temp', $filename);

            $tempPath = storage_path('app/' . $tempPath);
            $thumbnailPath = storage_path('app/public/temp/thumbnail/' . $filename);

            $exif = exif_read_data($tempPath);
            $exifHeaders = ['Orientation', 'ImageLength', 'ImageWidth'];

            $metadata = [];
            foreach ($exif as $header => $value) {
                if (in_array($header, $exifHeaders)) {
                    $metadata[$header] = $value;
                }
            }

            $orientation = $exif['Orientation'] == 6 ? 'portrait' : 'landscape';
            $width = $orientation == 'portrait' ? $exif['ImageLength'] : $exif['ImageWidth'];
            $height = $orientation == 'portrait' ? $exif['ImageWidth'] : $exif['ImageLength'];
            // Generate thumbnail
            FFMpeg::thumbnail($tempPath, $thumbnailPath, $width, $height);
            $aspect_ratio = $this->ffmpeg->categorizeRatio($width, $height);
            $attachment = Attachment::create([
                'filename' => $filename,
                'title' => $filename,
                'type' => $file->getClientOriginalExtension(),
                'owner' => $user->name,
                'width' => $width ?? 0,
                'height' => $height ?? 0,
                'aspect_ratio' => $aspect_ratio,
                'display_aspect_ratio' => '',
            ]);
            $attachment->save();

            Storage::disk('s3')->putFileAs('', $file, $filename);

            $thumbnail = File::get($thumbnailPath);

            Storage::disk('s3')->put('thumbnails/' . $filename, $thumbnail);

            // Remove temp media files
            Storage::delete('public/temp/thumbnail/' . $filename);
            Storage::delete('public/temp/' . $filename);
        }
        return redirect()->route('home');
    }
}
