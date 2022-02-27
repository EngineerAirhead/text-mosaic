<?php

declare(strict_types=1);

namespace EngineerAirhead\TextMosaic;

class Decoder
{
    public function decode($imagePath): string
    {
        $imageWidth = getimagesize($imagePath)[0];

        $im = imagecreatefrompng($imagePath);

        $string = '';

        $x = $y = 2;

        while (true) {
            if ($x > $imageWidth) {
                $x = 2;
                $y += 5;
            }

            $rgb = imagecolorat($im, $x, $y);

            if ($rgb === false) { // Scan position out of bounds
                break;
            }

            $colors = imagecolorsforindex($im, $rgb);

            if ($colors['alpha'] > 0) {
                break;
            }

            $hex = sprintf("%02x%02x%02x", $colors['red'], $colors['green'], $colors['blue']);

            $string .= hex2bin($hex);

            $x += 5;
        }

        return base64_decode($string);
    }
}