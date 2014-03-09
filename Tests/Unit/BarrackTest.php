<?php

namespace Tests\Unit;

use Sensorario\Yagolands\Building\Barrack;
use Sensorario\Yagolands\Resources;

/**
 * Class BarrackTest
 * @package Tests\Unit
 */
class BarrackTest extends \PHPUnit_Framework_TestCase
{
    public function testBarrack()
    {
        $barrack = new Barrack();
        $this->assertEquals(35, $barrack->resourceForNextLevel(Resources::GRANO));
        $this->assertEquals(43, $barrack->resourceForNextLevel(Resources::FERRO));
        $this->assertEquals(39, $barrack->resourceForNextLevel(Resources::ARGILLA));
        $this->assertEquals(41, $barrack->resourceForNextLevel(Resources::WOOD));
    }

    public function testResourcesInLevels()
    {
        $barrack = new Barrack();
        $this->assertEquals(35, $barrack->resourceForNextLevel(Resources::GRANO, 1));
        $this->assertEquals(46, $barrack->resourceForNextLevel(Resources::GRANO, 2));
    }
}
