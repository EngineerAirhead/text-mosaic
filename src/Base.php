<?php

namespace EngineerAirhead\TextMosaic;

use EngineerAirhead\TextMosaic\Adapter\Adapter;

class Base
{
    const PIXEL_SIZE = 5;
    const PIXEL_HALFWAY_POINT = 2;

    public function __construct(protected Adapter $adapter)
    {

    }
}