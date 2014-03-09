<?php

namespace Tests\Unit;

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
        $this->assertEquals(33, $castle->resourceToNextLevel(Resources::GRANO));
        $this->assertEquals(42, $castle->resourceToNextLevel(Resources::FERRO));
        $this->assertEquals(37, $castle->resourceToNextLevel(Resources::ARGILLA));
        $this->assertEquals(40, $castle->resourceToNextLevel(Resources::WOOD));
    }
}
