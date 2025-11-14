<?php

namespace EngineerAirhead\test;

use EngineerAirhead\TextMosaic\Adapter\GD;
use EngineerAirhead\TextMosaic\Decoder;
use PHPUnit\Framework\TestCase;

class DecodeTest extends TestCase
{
    public function testEncode()
    {
        $expected = 'This is a nice example :D';
        $actual = (new Decoder(new GD()))->decode(__DIR__ . '/../img/example.png');

        $this->assertSame($expected, $actual);
    }
}