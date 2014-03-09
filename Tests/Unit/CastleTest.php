<?php

namespace Tests\Unit;

use Sensorario\Yagolands\Building\Castle;
use Sensorario\Yagolands\Resources;

/**
 * Class CastleTest
 * @package Tests\Unit
 */
class CastleTest extends \PHPUnit_Framework_TestCase
{
    public function testFirstLevel()
    {
        $castle = new Castle();
        $this->assertEquals(33, $castle->resourceForNextLevel(Resources::GRANO));
        $this->assertEquals(42, $castle->resourceForNextLevel(Resources::FERRO));
        $this->assertEquals(37, $castle->resourceForNextLevel(Resources::ARGILLA));
        $this->assertEquals(40, $castle->resourceForNextLevel(Resources::WOOD));
    }
}
