<?php

namespace App\Http\Controllers;

use App\Services\Curl;
use Illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
    /**
     * @var Curl
     */
    private $curlService;

    public function __construct(Curl $curlService)
    {
        $this->curlService = $curlService;
    }

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

    public function thumbnail($filename) {

        $url = config('app.thumbnail_url') . $filename;
        $thumbnail = $this->curlService->get($url, ['x-api-key: ' . config('app.thumbnail_key')]);

        if (is_array($thumbnail)) {
            echo $thumbnail['src'];
        }
        else {
            echo 'There was a problem: ' . $thumbnail;
        }

    }

    public function download(Request $request) {
        if ($request->has('file')) {
            $file = $request->input('file');
            return Storage::disk('s3')->download($file);
        }

    }

    public function getThumbnails($images) {
        // Initialize the cURL multi handle
        dd($images);
        $multiHandle = curl_multi_init();

        // Store individual cURL handles and add them to the multi handle
        $curlHandles = [];
        $rounds = count( $images );

        for ( $i = 0; $i < $rounds; $i++ ) {
            //
            $url = $base_url . $images[$i];

            $curlHandles[$i] = curl_init();

            curl_setopt( $curlHandles[$i], CURLOPT_URL, $url );
            curl_setopt( $curlHandles[$i], CURLOPT_HTTPHEADER, [ 'x-api-key:' . $apiKey] );
            curl_setopt( $curlHandles[$i], CURLOPT_RETURNTRANSFER, 1 );
            // curl_setopt( $curlHandles[$i], CURLOPT_STDERR, fopen( 'php://stdout', 'w' ) );
            // curl_setopt( $curlHandles[$i], CURLOPT_VERBOSE, true );
            curl_multi_add_handle( $multiHandle, $curlHandles[$i] );
        }

        // Execute the multi handle and wait for all the requests to complete
        $active = null;
        do {
            $status = curl_multi_exec( $multiHandle, $active );

            if ( $status > 0 ) {
                // TODO: error handling/logging

            }
            curl_multi_select( $multiHandle );
        } while ( $active );

        // Collect the responses and close the individual cURL handles
        $responses = [];
        for ( $i = 0; $i < $rounds; $i++ ) {
            $responses[] = json_decode( curl_multi_getcontent( $curlHandles[$i] ), true );
            curl_multi_remove_handle( $multiHandle, $curlHandles[$i] );
            curl_close( $curlHandles[$i] );
        }

        // Close the cURL multi handle
        curl_multi_close( $multiHandle );

    }
}
