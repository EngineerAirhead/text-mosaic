<?php

declare(strict_types=1);

namespace EngineerAirhead\TextMosaic;

class Encoder
{
    public function encode(string $data)
    {
        $encoded = base64_encode($data);

        $chunks = str_split($encoded, 3);
        $chunkSize = count($chunks);
        $imageChunkWidth = ceil(sqrt($chunkSize));

        $blockSize = 5;

        $imageSize = $imageChunkWidth * $blockSize;

        $image = $this->createImageResource((int)$imageSize);

        $column = 0;
        $row = 0;

        $imageColors = [];

        foreach ($chunks as $char) {
            $padded = str_pad($char, 3, '.');

            $hex = bin2hex($padded);

            if (!array_key_exists($hex, $imageColors)) {
                list($r, $g, $b) = sscanf(bin2hex($padded), '%02x%02x%02x');

                $imageColors[$hex] = imagecolorallocate($image, $r, $g, $b);
            }

            $squareColor = $imageColors[$hex];

            if ($column >= $imageChunkWidth) {
                $column = 0;
                $row++;
            }

            $x1 = $column * $blockSize;
            $y1 = $row * $blockSize;
            $x2 = $x1 + ($blockSize - 1);
            $y2 = $y1 + ($blockSize - 1);

            imagefilledrectangle($image, $x1, $y1, $x2, $y2, $squareColor);

            $column++;
        }

        $stream = fopen('php://memory', 'w+');

        imagepng($image, $stream);

        rewind($stream);

        $encodedImage = stream_get_contents($stream);

        return base64_encode($encodedImage);
    }

    /**
     * @param int $size
     * @return false|\GdImage|resource
     */
    private function createImageResource(int $size)
    {
        $image = imagecreatetruecolor($size, $size);

        imagesavealpha($image, true);
        $color = imagecolorallocatealpha($image, 0, 0, 0, 127);
        imagefill($image, 0, 0, $color);

        return $image;
    }
}