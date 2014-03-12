<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use Sensorario\Dungeon\Village;

class VillageTest extends PHPUnit_Framework_TestCase
{
    public function testIsDungeonInstance()
    {
        $village = new Village();
        $this->assertTrue(is_subclass_of($village, 'Sensorario\Dungeon\Dungeon'));
    }

    public function testVillageCheckIfCoreIsBuiltOrNot()
    {
        $village = new Village();
        $this->assertTrue(true === $village->coreIsBuilt());
    }

    /**
     * @expectedException Sensorario\Dungeon\VillageCannotGrowException
     */
    public function testVillageCannotGrow()
    {
        $tile = $this->getMockBuilder('Sensorario\Dungeon\Tile')
            ->disableOriginalConstructor()
            ->getMock();

        $village = new Village();
        $village->addTile($tile);
    }
}
