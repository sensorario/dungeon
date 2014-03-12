<?php

namespace Tests\Unit;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Village;

class VillageTest extends PHPUnit_Framework_TestCase
{
    public function testIsDungeonInstance()
    {
        $village = new Village();
        $this->assertTrue(is_subclass_of($village, 'Sensorario\Yagolands\Dungeon'));
    }

    public function testVillageHasOwner()
    {
        $user = $this->getMockBuilder('Sensorario\Yagolands\Player')
            ->disableOriginalConstructor()
            ->getMock();

        $village = new Village();
        $village->setOwner($user);
    }

    public function testVillageCheckIfCoreIsBuiltOrNot()
    {
        $village = new Village();
        $this->assertTrue(true === $village->coreIsBuilt());
    }

    /**
     * @expectedException Sensorario\Yagolands\Exceptions\VillageCannotGrowException
     */
    public function testVillageCannotGrow()
    {
        $tile = $this->getMockBuilder('Sensorario\Yagolands\Tile')
            ->disableOriginalConstructor()
            ->getMock();

        $village = new Village();
        $village->addTile($tile);
    }
}
