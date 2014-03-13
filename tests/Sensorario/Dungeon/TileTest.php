<?php

namespace Tests\Sensorario\Dungeon;

use PHPUnit_Framework_TestCase;
use Sensorario\Dungeon\Directions;
use Sensorario\Dungeon\Tile;

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
        $this->assertEquals([$toX, $toY], $tile->move(Directions::RIGHT_UP)->getCoordinates());
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

    public function testConstructorWithoutParameters()
    {
        $tile = new Tile();
        $this->assertTrue([0, 0] === $tile->getCoordinates());
    }
}
