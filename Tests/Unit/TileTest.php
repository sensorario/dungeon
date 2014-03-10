<?php

namespace Tests\Unit;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Directions;
use Sensorario\Yagolands\Tile;

/**
 * Class TileTest
 * @package Tests\Unit
 */
class TileTest extends PHPUnit_Framework_TestCase
{
    public function testTile()
    {
        $tile = new Tile(0, 0);
        $this->assertEquals([0, 0], $tile->getCoordinates());
    }

    public function testRight()
    {
        $tile = new Tile(0, 0);
        $this->assertEquals([1, 0], $tile->move(Directions::RIGHT)->getCoordinates());
    }

    public function testLeft()
    {
        $tile = new Tile(0, 0);
        $this->assertEquals([-1, 0], $tile->move(Directions::LEFT)->getCoordinates());
    }

    /**
     * @dataProvider centerAndUpRightDestinations
     */
    public function testUpRight($fromX, $fromY, $toX, $toY)
    {
        $tile = new Tile($fromX, $fromY);
        $this->assertEquals([$toX, $toY], $tile->move(DIRECTIONS::RIGHT_UP)->getCoordinates());
    }

    public function centerAndUpRightDestinations()
    {
        return [
            [0, 0, 0, 1],
            [-1, 1, 0, 2],
        ];
    }

    /**
     * @dataProvider centerAndUpLeftDestinations
     */
    public function testUpLeft($fromX, $fromY, $toX, $toY)
    {
        $tile = new Tile($fromX, $fromY);
        $this->assertEquals([$toX, $toY], $tile->move(Directions::LEFT_UP)->getCoordinates());
    }

    public function centerAndUpLeftDestinations()
    {
        return [
            [0, 0, -1, 1],
            [-1, -1, -1, 0],
        ];
    }

    /**
     * @dataProvider centerAndDownRightDestinations
     */
    public function testDownRight($fromX, $fromY, $toX, $toY)
    {
        $tile = new Tile($fromX, $fromY);
        $this->assertEquals([$toX, $toY], $tile->move(Directions::DOWN_RIGHT)->getCoordinates());
    }

    public function centerAndDownRightDestinations()
    {
        return [
            [0, 0, 0, -1],
            [-1, +1, 0, 0],
        ];
    }

    /**
     * @dataProvider centerAndDownLeftDestinations
     */
    public function testDownLeft($fromX, $fromY, $toX, $toY)
    {
        $tile = new Tile($fromX, $fromY);
        $this->assertEquals([$toX, $toY], $tile->move(Directions::DOWN_LEFT)->getCoordinates());
    }

    public function centerAndDownLeftDestinations()
    {
        return [
            [0, 0, -1, -1],
            [0, 1, 0, 0],
        ];
    }

    public function testTileHasNotOwner()
    {
        $tile = new Tile(0, 0);
        $this->assertFalse($tile->hasOwner());
    }

    public function testTileCanBeOwned()
    {
        $owner = $this->getMockBuilder('Sensorario\Yagolands\Player')
            ->disableOriginalConstructor()
            ->getMock();

        $tile = new Tile(3, 4);
        $tile->setOwner($owner);
        $this->assertTrue($tile->hasOwner());
    }
}
