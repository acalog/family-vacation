<?php

namespace App\Services;

class FFMpeg
{
    public static function thumbnail($filename, $thumbnailOutput) {

        $command = 'ffmpeg -i ';
        $command .= $filename . ' ';
        $command .= '-vf scale=-1:500 -update true ';
        $command .= $thumbnailOutput;

        exec($command, $output, $retval);
    }

    public static function info($filename) {
        $command = 'ffmpeg -i ';
        $command .= $filename . ' ';
        $command .= '-f ffmetadata - 2>&1';
        exec($command, $output, $retval);

        dd($output);
    }

    public static function probe($filename) {
        // ffprobe -v quiet -print_format json -show_format -show_streams input_image.jpg
        $command = 'ffprobe -v quiet -print_format json -show_format -show_streams ';
        $command .= $filename;
        exec($command, $output, $retval);

        $metadata = [];

        foreach($output as $o) {

            if (str_contains($o, 'width')) {
                $metadata['width'] = trim($o);
                continue;
            }
            if (str_contains($o, 'display_aspect_ratio')) {
                $metadata['display_aspect_ratio'] = trim($o);
                continue;
            }
            if (str_contains($o, 'height')) {
                $metadata['height'] = trim($o);
            }

        }
        $patterns = [
            'width' => '/"coded_width": (\d+),/',
            'height' => '/"coded_height": (\d+),/',
            'display_aspect_ratio' => '/"display_aspect_ratio": "(\d+:\d+)",/'
        ];
        $results = [];

        foreach ($metadata as $key => $value) {
            if (preg_match($patterns[$key], $value, $matches)) {
                $results[$key] = $matches[1];
            }
        }
        return $results;
    }

    private function gcd($a, $b) {
        while ($b != 0) {
            $t = $b;
            $b = $a % $b;
            $a = $t;
        }
        return $a;
    }

    private function reduceRatio($width, $height) {
        $gcd = $this->gcd($width, $height);
        return [$width / $gcd, $height / $gcd];
    }

    public function categorizeRatio($width, $height) {
        // Standard aspect ratios
        $standardRatios = [
            '1:1' => [1, 1],
            '4:3' => [4, 3],
            '3:2' => [3, 2],
            '16:9' => [16, 9],
            '21:9' => [21, 9],
            // Add more standard ratios if needed
        ];

        // Reduce the ratio
        list($reducedWidth, $reducedHeight) = $this->reduceRatio($width, $height);

        // Find the closest standard ratio
        $closestRatio = null;
        $closestDiff = PHP_INT_MAX;

        foreach ($standardRatios as $name => $ratio) {
            $diff = abs($ratio[0] / $ratio[1] - $reducedWidth / $reducedHeight);
            if ($diff < $closestDiff) {
                $closestDiff = $diff;
                $closestRatio = $name;
            }
        }

        return $closestRatio;
    }

}
