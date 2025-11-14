<?php

namespace EngineerAirhead\test;

use EngineerAirhead\TextMosaic\Adapter\GD;
use EngineerAirhead\TextMosaic\Encoder;
use PHPUnit\Framework\TestCase;

class EncodeTest extends TestCase
{
    public function testEncode()
    {
        $expected = 'iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAAS0lEQVQokWMMc8/4z4AGpGQE0YUYLvG+whBjwhAhAQxRzSzKvzEFLzy9iSGmJf2QujYPUc0sN1SfYwgqvXqHITZl7llGqto8RDUDAAevDuWqOMBoAAAAAElFTkSuQmCC';
        $actual = (new Encoder(new GD()))->encode('This is a test :D');

        $this->assertSame($expected, $actual);
    }
}