<?php

declare(strict_types=1);

namespace EngineerAirhead\TextMosaic;

final class Decoder extends Base
{
    public function decode($imagePath): string
    {
        $this->adapter->createImageFromSquare($imagePath);

        $imageWidth = getimagesize($imagePath)[0];

        $string = '';

        $x = $y = self::PIXEL_HALFWAY_POINT;

        while (true) {
            if ($x > $imageWidth) {
                $x = self::PIXEL_HALFWAY_POINT;
                $y += self::PIXEL_SIZE;
            }

            $rgb = $this->adapter->imageColorAt($x, $y);

            if ($rgb === false) { // Scan position out of bounds
                break;
            }

            $colors = $this->adapter->imageColorForIndex($rgb);

            if ($colors['alpha'] > 0) {
                break;
            }

            $hex = sprintf("%02x%02x%02x", $colors['red'], $colors['green'], $colors['blue']);

            $string .= hex2bin($hex);

            $x += self::PIXEL_SIZE;
        }

        return base64_decode($string);
    }
}