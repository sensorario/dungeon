<?php

namespace Sensorario\Yagolands;

class Map
{
    private $tiles;

    public function __construct(Tile $center, $rounds)
    {
        $this->tiles[] = [
            $center->getCoordinates(),
            0
        ];

        $position = $center;
        for ($i = 1; $i < $rounds; $i++) {
            $position->move(Directions::RIGHT_UP);

            foreach (Directions::getDirections() as $direction) {
                for ($j = 0; $j < $i; $j++) {
                    $this->tiles[] = [$position->move($direction)->getCoordinates(), $i];
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
        $this->tiles[$index][1] = $distance;
    }

    public function hasTile(Tile $tile)
    {
        foreach ($this->tiles as $item) {
            if ($item[0] == $tile->getCoordinates()) {
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
        return $this->getAllTiles()[$index][1];
    }

    public function getTileAtIndex($index)
    {
        return $this->getAllTiles()[$index];
    }

    public function getTileDistanceByCoordinate($x, $y)
    {
        foreach ($this->tiles as $tile) {
            if ([$x, $y] == $tile[0]) {
                return $tile[1];
            }
        }
    }

    public function getTileIndexByCoordinate($x, $y)
    {
        foreach ($this->tiles as $index => $tile) {
            if ([$x, $y] == $tile[0]) {
                return $index;
            }
        }
    }
}
