<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Services\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ActionController extends Controller
{
    protected $curlService;

    public function __construct(Curl $curlService)
    {
        $this->curlService = $curlService;
    }

    public function home (Request $request) {
        if (Auth::check()) {
            $images = Attachment::all();

            $columns = array_fill(0, 4, []);
            $total = $images->count();
            // Total images to fully load. The rest will be lazy-loaded.
            $max_load = 30;
            foreach ($images as $index => $image) {
                if ($index <= $max_load) {
                    $image->loadNow = true;
                }
                $column_index = $index % 4;
                $columns[$column_index][] = $image;
            }

            return view('content.home')->with(['images' => $images, 'columns' => $columns]);
        }
        else {
            return view('welcome');
        }
    }

    public function showImageDetails(Request $request) {

        if ($request->has('id'))
        {
            $id = $request->input('id');

            $image = Attachment::find($id);

            return view('content.details')->with(['image' => $image]);
        }
    }

    public function getThumbnails($images) {
        // Initialize the cURL multi handle
        $base_url = 'https://bv5hcib5vl.execute-api.us-east-1.amazonaws.com/Prod/resize/';
        $multiHandle = curl_multi_init();
        $apiKey = 'laoy3M3AnO6MqkJF7uZ3E67HjEUdtZv12pPmj5mx';
        // Store individual cURL handles and add them to the multi handle
        $curlHandles = [];
        $rounds = count( $images );
        $max = 10;
        foreach ($images as $index => $image) {
            //
            if ($index >= $max) {
                break;
            }
            $url = $base_url . $image->filename;

            $curlHandles[$index] = curl_init();

            curl_setopt( $curlHandles[$index], CURLOPT_URL, $url );
            curl_setopt( $curlHandles[$index], CURLOPT_HTTPHEADER, [ 'x-api-key:' . $apiKey] );
            curl_setopt( $curlHandles[$index], CURLOPT_RETURNTRANSFER, 1 );
            // curl_setopt( $curlHandles[$i], CURLOPT_STDERR, fopen( 'php://stdout', 'w' ) );
            // curl_setopt( $curlHandles[$i], CURLOPT_VERBOSE, true );
            curl_multi_add_handle( $multiHandle, $curlHandles[$index] );
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
        for ( $i = 0; $i < $max; $i++ ) {
            $responses[] = json_decode( curl_multi_getcontent( $curlHandles[$i] ), true );
            curl_multi_remove_handle( $multiHandle, $curlHandles[$i] );
            curl_close( $curlHandles[$i] );
        }

        // Close the cURL multi handle
        curl_multi_close( $multiHandle );
        return $responses;
    }
}
