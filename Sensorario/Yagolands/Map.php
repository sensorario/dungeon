<?php

namespace Sensorario\Yagolands;

class Map
{
    private $tiles;

    public function __construct(Tile $center, $rounds)
    {
        $distance = 0;

        $this->tiles[] = [
            $center->getCoordinates(),
            $distance
        ];

        $position = $center;
        for ($i = 1; $i < $rounds; $i++) {
            $position->move(Directions::RIGHT_UP);
            $distance++;

            foreach (Directions::getDirections() as $direction) {
                for ($j = 0; $j < $i; $j++) {
                    $moved = $position->move($direction);
                    $this->tiles[] = [
                        $moved->getCoordinates(),
                        $distance
                    ];
                }
            }
        }
    }

    public function getTiles()
    {
        return $this->tiles;
    }

    public function setTileDistance($tileIndex, $distance)
    {
        $this->tiles[$tileIndex][1] = $distance;
    }

    public function tileExists(Tile $tileToFind)
    {
        foreach ($this->tiles as $tile) {
            if ($tile[0] == $tileToFind->getCoordinates()) {
                return true;
            }
        }

        return false;
    }

    public function addTile(Tile $tile, $distance)
    {
        $this->tiles[] = [$tile->getCoordinates(), $distance];
    }

    public function getDistanceAtIndex($index)
    {
        return $this->getTiles()[$index][1];
    }

    public function getTileAtIndex($index)
    {
        return $this->getTiles()[$index];
    }

    public function getDistanceAtCoordinate($x, $y)
    {
        foreach ($this->tiles as $tile) {
            if ([$x, $y] == $tile[0]) {
                return $tile[1];
            }
        }
    }

    public function getTileIndexFromCoordinate($x, $y)
    {
        foreach ($this->tiles as $index => $tile) {
            if ([$x, $y] == $tile[0]) {
                return $index;
            }
        }
    }
}
