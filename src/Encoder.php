<?php

declare(strict_types=1);

namespace EngineerAirhead\TextMosaic;

final class Encoder extends Base
{
    private int $chunkLength = 3;

    public function encode(string $data): string
    {
        $encoded = base64_encode($data);

        $chunks = str_split($encoded, $this->chunkLength);
        $chunkSize = count($chunks);
        $imageChunkWidth = ceil(sqrt($chunkSize));

        $imageSize = $imageChunkWidth * self::PIXEL_SIZE;

        $this->adapter->createImageFromSize((int)$imageSize);

        $column = 0;
        $row = 0;

        $imageColors = [];

        foreach ($chunks as $char) {
            $padded = str_pad($char, $this->chunkLength, '.');

            $hex = bin2hex($padded);

            if (!array_key_exists($hex, $imageColors)) {
                $rgb = sscanf(bin2hex($padded), '%02x%02x%02x');

                $imageColors[$hex] = $this->adapter->imageColorAllocate(...$rgb);
            }

            $squareColor = $imageColors[$hex];

            if ($column >= $imageChunkWidth) {
                $column = 0;
                $row++;
            }

            $x1 = $column * self::PIXEL_SIZE;
            $y1 = $row * self::PIXEL_SIZE;
            $x2 = $x1 + (self::PIXEL_SIZE - 1);
            $y2 = $y1 + (self::PIXEL_SIZE - 1);

            $this->adapter->addSquareToImage($x1, $y1, $x2, $y2, $squareColor);

            $column++;
        }

        $stream = fopen('php://memory', 'w+');

        $this->adapter->streamImage($stream);

        rewind($stream);

        $encodedImage = stream_get_contents($stream);

        return base64_encode($encodedImage);
    }
}