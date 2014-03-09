<?php

namespace Tests\Unit;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Tile;
use Sensorario\Yagolands\Map;

class MapTest extends PHPUnit_Framework_TestCase
{
    public function testTileIsCoordinateWithPosition()
    {
        $tile = new Map(new Tile(2, 3), 1);
        $this->assertEquals([0 => [2, 3]], $tile->getTilesCoordinate());
        $this->assertEquals([[2, 3]], $tile->getTilesCoordinate());
    }

    public function testRounds()
    {
        $tile = new Map(new Tile(0, 0), 2);
        $this->assertEquals(
            [
                [0, 0], // centro
                [1, 0], // primo girone
                [0, -1],
                [-1, -1],
                [-1, 0],
                [-1, 1],
                [0, 1]
            ],
            $tile->getTilesCoordinate()
        );
    }

    public function testThreeRounds()
    {
        $tile = new Map(new Tile(0, 0), 3);
        $this->assertEquals(
            [
                [0, 0], // centro
                [1, 0], // primo girone
                [0, -1],
                [-1, -1],
                [-1, 0],
                [-1, 1],
                [0, 1],
                [1, 1], // secondo girone
                [2, 0],
                [1, -1],
                [1, -2],
                [0, -2],
                [-1, -2],
                [-2, -1],
                [-2, 0],
                [-2, 1],
                [-1, 2],
                [0, 2],
                [1, 2],
            ],
            $tile->getTilesCoordinate()
        );
    }
}
