<?php

namespace App\Services;

class Curl {

    public function get($url, $headers = [], $body = []) {
        $curl = curl_init();

        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => $headers, // ['x-api-key: ' . $apiKey]
        ];

        curl_setopt_array($curl, $options);

        // Execute the request
        $response = curl_exec($curl);

        // Get the HTTP status code
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Close the cURL session
        curl_close($curl);

        // Handle the response
        if ($httpStatus >= 200 && $httpStatus < 300) {
            return json_decode($response, true);
        } else {
            $err = curl_error($curl);
            $statusText = 'Error'; // Default status text, you can improve this
            return $err;
        }



    }
}
