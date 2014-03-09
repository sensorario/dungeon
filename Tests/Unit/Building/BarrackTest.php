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
        $this->assertEquals(35, $barrack->resourceToNextLevel(Resources::GRANO));
        $this->assertEquals(43, $barrack->resourceToNextLevel(Resources::FERRO));
        $this->assertEquals(39, $barrack->resourceToNextLevel(Resources::ARGILLA));
        $this->assertEquals(41, $barrack->resourceToNextLevel(Resources::WOOD));
    }

    public function testResourcesInLevels()
    {
        $barrack = new Barrack();
        $this->assertEquals(35, $barrack->resourceToNextLevel(Resources::GRANO, 1));
        $this->assertEquals(46, $barrack->resourceToNextLevel(Resources::GRANO, 2));
    }
}
