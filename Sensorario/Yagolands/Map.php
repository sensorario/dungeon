<?php

namespace Sensorario\Yagolands;

class Map
{
    private $tiles;

    const COORDINATES = 0;

    const DISTANCE = 1;

    const IS_ON_THE_EDGE = 2;

    public function __construct(Tile $position, $rounds)
    {
        $this->addTile($position);

        for ($round = 1; $round < $rounds; $round++) {
            $position->move(Directions::RIGHT_UP);

            foreach (Directions::getDirections() as $direction) {
                for ($step = 0; $step < $round; $step++) {
                    $this->addTile($position->move($direction), $round);
                }
            }
        }
    }

    public function getAllTiles()
    {
        return $this->tiles;
    }

    public function setTileDistance($index, $distance)
    {
        $this->tiles[$index][self::DISTANCE] = $distance;
    }

    public function hasTile(Tile $tile)
    {
        foreach ($this->tiles as $item) {
            if ($item[self::COORDINATES] == $tile->getCoordinates()) {
                return true;
            }
        }

        return false;
    }

    public function addTile(Tile $tile, $distance = 0)
    {
        $this->tiles[] = [$tile->getCoordinates(), $distance];
    }

    public function getDistanceAtIndex($index)
    {
        return $this->getAllTiles()[$index][self::DISTANCE];
    }

    public function getTileAtIndex($index)
    {
        return $this->getAllTiles()[$index];
    }

    public function getTileDistanceByCoordinate($x, $y)
    {
        foreach ($this->tiles as $tile) {
            if ([$x, $y] == $tile[self::COORDINATES]) {
                return $tile[self::DISTANCE];
            }
        }
    }

    public function getTileIndexByCoordinate($x, $y)
    {
        foreach ($this->tiles as $index => $tile) {
            if ([$x, $y] == $tile[self::COORDINATES]) {
                return $index;
            }
        }
    }

    public function isTileOnTheEdge(Tile $tile)
    {
        foreach ($this->tiles as $item) {
            if ($item[self::COORDINATES] == $tile->getCoordinates()) {
                if ($item[self::DISTANCE] == self::IS_ON_THE_EDGE) {
                    return true;
                }
            }
        }

        return false;
    }
}
