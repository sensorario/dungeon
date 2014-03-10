<?php

namespace Sensorario\Yagolands;

class World
{
    private $name;

    private $map;

    private $freeIndexIsRandom = false;

    public function __construct($name)
    {
        $this->name = $name;
        $this->map = new Map(new Tile(0, 0), 3);
    }

    public function getName()
    {
        return $this->name;
    }

    public function countTiles()
    {
        return count($this->map->getTiles());
    }

    /**
     * @param $index
     * @return Tile
     */
    public function getTileAtIndex($index)
    {
        return $this->map->getTiles()[$index];
    }

    public function getMap()
    {
        return $this->map;
    }

    public function addPlayer(Player $player)
    {
        $this->players[] = $player;
    }

    public function countPlayers()
    {
        return count($this->players);
    }

    public function findFreeIndex()
    {
        $tiles = $this->getMap()->getTiles();
        foreach ($tiles as $index => $tile) {
            if ($tile[1] == 2) {
                return $index;
            }
        }
    }

    public function buildAroundTileAtIndex($index)
    {
        $this->freeIndexIsRandom = true;

        $roundToBuild = 2;
        $center = $this->getMap()->getTiles()[$index];
        $centerX = $center[0][0];
        $centerY = $center[0][1];
        $position = new Tile($centerX, $centerY);

        $tileIndex = $this->getMap()->getTileIndexFromCoordinate($centerX, $centerY);
        $this->getMap()->setTileDistance($tileIndex, 0);

        for ($i = 1; $i <= $roundToBuild; $i++) {
            $position->move(Directions::RIGHT_UP);

            foreach (Directions::getDirections() as $direction) {
                for ($j = 0; $j < $i; $j++) {
                    $moved = $position->move($direction);
                    $coordinates = $moved->getCoordinates();
                    $x = $coordinates[0];
                    $y = $coordinates[1];
                    $tileNotExists = !$this->getMap()->tileExists(new Tile($x, $y));
                    if ($tileNotExists) {
                        $this->getMap()->addTile(new Tile($x, $y), $i);
                    } else {
                        $distanceAtCoordinate = $this->getMap()->getDistanceAtCoordinate($x, $y);
                        if ($i == 1) {
                            if ($distanceAtCoordinate == 2) {
                                $newTileIndex = $this->getMap()->getTileIndexFromCoordinate($x, $y);
                                $this->getMap()->setTileDistance($newTileIndex, 1);
                            }
                        }
                    }
                }
            }
        }
    }

    public function freeIndexIsRandom()
    {
        return $this->freeIndexIsRandom;
    }
}
