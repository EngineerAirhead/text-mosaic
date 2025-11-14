<?php

namespace EngineerAirhead\TextMosaic\Adapter;

abstract class Adapter
{
    /**
     * Depending on the adapter in use
     * @var resource|null
     */
    protected $image = null;

    /******************
     * Encode methods *
     ******************/

    /**
     * Creates an image resource within the adapter for encoding
     *
     * @param int $imageSize
     * @return void
     */
    abstract public function createImageFromSize(int $imageSize): void;

    /**
     * Allocate a color for an image
     *
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return int|false A color identifier or <b>FALSE</b> if the allocation failed.
     */
    abstract public function imageColorAllocate(int $red, int $green, int $blue): int|false;

    /**
     * @param int $x1
     * @param int $y1
     * @param int $x2
     * @param int $y2
     * @param int $squareColor
     * @return bool
     */
    abstract public function addSquareToImage(int $x1, int $y1, int $x2, int $y2, int $squareColor): bool;

    /**
     * @param resource $stream
     * @return void
     */
    abstract public function streamImage($stream): void;

    /******************
     * Decode methods *
     ******************/

    /**
     * Creates an image resource within the adapter for decoding
     *
     * @param string $imagePath
     * @return void
     */
    abstract public function createImageFromSquare(string $imagePath): void;

    /**
     * Returns the width and height of an image
     *
     * @param string $imagePath
     * @return array{width:int, height:int}
     */
    abstract public function getImageSize(string $imagePath): array;

    /**
     * Get the index of the color of a pixel based on x and y coordinates
     *
     * @param int $x
     * @param int $y
     * @return int|false the index of the color or false on failure
     */
    abstract public function imageColorAt(int $x, int $y): int|false;

    /**
     * Get the colors for an index
     *
     * @param int $color
     * @return array{red: int, green: int, blue: int, alpha: int}|false
     */
    abstract public function imageColorForIndex(int $color): array|false;
}
