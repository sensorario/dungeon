<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use Sensorario\Dungeon\LittleMap;

class LittleMapTest extends PHPUnit_Framework_TestCase
{
    public function testIsDungeonInstance()
    {
        $village = new LittleMap();
        $this->assertTrue(is_subclass_of($village, 'Sensorario\Dungeon\Dungeon'));
    }

    public function testVillageCheckIfCoreIsBuiltOrNot()
    {
        $village = new LittleMap();
        $this->assertTrue(true === $village->coreIsBuilt());
    }

    /**
     * @expectedException Sensorario\Dungeon\LittleMapCannotGrowException
     */
    public function testVillageCannotGrow()
    {
        $tile = $this->getMockBuilder('Sensorario\Dungeon\Tile')
            ->disableOriginalConstructor()
            ->getMock();

        $village = new LittleMap();
        $village->addTile($tile);
    }

    public function testMapSizes()
    {
        $map = new LittleMap();
        $this->assertEquals(19, $map->countTiles());
    }
}
