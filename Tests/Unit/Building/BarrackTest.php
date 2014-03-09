<?php

namespace Tests\Unit\Building;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Building\Barrack;
use Sensorario\Yagolands\Resources;

/**
 * Class BarrackTest
 * @package Tests\Unit
 */
class BarrackTest extends PHPUnit_Framework_TestCase
{
    public function testBarrack()
    {
        $barrack = new Barrack();
        $this->assertEquals(35, $barrack->resourceForLevel(Resources::GRANO, 1));
        $this->assertEquals(43, $barrack->resourceForLevel(Resources::FERRO, 1));
        $this->assertEquals(39, $barrack->resourceForLevel(Resources::ARGILLA, 1));
        $this->assertEquals(41, $barrack->resourceForLevel(Resources::WOOD, 1));
    }

    public function testResourcesInLevels()
    {
        $barrack = new Barrack();
        $this->assertEquals(35, $barrack->resourceForLevel(Resources::GRANO, 1));
        $this->assertEquals(46, $barrack->resourceForLevel(Resources::GRANO, 2));
    }
}
