<?php

namespace EngineerAirhead\TextMosaic\Adapter;

use GdImage;

class GD extends Adapter
{
    public function createImageFromSize(int $imageSize): void
    {
        $this->image = imagecreatetruecolor($imageSize, $imageSize);
        imagesavealpha($this->image, true);

        $color = imagecolorallocatealpha($this->image, 0, 0, 0, 127);
        imagefill($this->image, 0, 0, $color);
    }

    public function imageColorAllocate(int $red, int $green, int $blue): int|false
    {
        if (!$this->image instanceof GdImage) {
            return false;
        }

        return imagecolorallocate($this->image, $red, $green, $blue);
    }

    public function addSquareToImage(int $x1, int $y1, int $x2, int $y2, int $squareColor): bool
    {
        if (!$this->image instanceof GdImage) {
            return false;
        }

        return imagefilledrectangle($this->image, $x1, $y1, $x2, $y2, $squareColor);
    }

    public function streamImage($stream): void
    {
        if (!$this->image instanceof GdImage) {
            return;
        }

        imagepng($this->image, $stream);
    }

    public function createImageFromSquare(string $imagePath): void
    {
        $this->image = imagecreatefrompng($imagePath);
    }

    public function getImageSize(string $imagePath): array
    {
        return array_combine(['width', 'height'], getimagesize($imagePath));
    }

    public function imageColorAt(int $x, int $y): int|false
    {
        if (!$this->image instanceof GdImage) {
            return false;
        }

        return @imagecolorat($this->image, $x, $y);
    }

    public function imageColorForIndex(int $color): array|false
    {
        if (!$this->image instanceof GdImage) {
            return false;
        }

        return imagecolorsforindex($this->image, $color);
    }
}
