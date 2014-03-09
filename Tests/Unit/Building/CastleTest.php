<?php

namespace Tests\Unit\Building;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Building\Castle;
use Sensorario\Yagolands\Resources;

/**
 * Class CastleTest
 * @package Tests\Unit
 */
class CastleTest extends PHPUnit_Framework_TestCase
{
    public function testFirstLevel()
    {
        $castle = new Castle();
        $this->assertEquals(33, $castle->resourceForLevel(Resources::GRANO, 1));
        $this->assertEquals(42, $castle->resourceForLevel(Resources::FERRO, 1));
        $this->assertEquals(37, $castle->resourceForLevel(Resources::ARGILLA, 1));
        $this->assertEquals(40, $castle->resourceForLevel(Resources::WOOD, 1));
    }
}
