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
        return count($this->map->getAllTiles());
    }

    /**
     * @param $index
     * @return Tile
     */
    public function getTileAtIndex($index)
    {
        return $this->map->getAllTiles()[$index];
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

    public function getEdgeTile()
    {
        $tiles = $this->getMap()->getAllTiles();

        if ($this->freeIndexIsRandom) {
            while (true) {
                $rand = rand(0, count($tiles) - 1);
                if ($tiles[$rand][1] == 2) {
                    return $rand;
                }
            }
        }

        foreach ($tiles as $index => $tile) {
            if ($tile[1] == 2) {
                return $index;
            }
        }
    }

    public function growAroundEdgeTile($index)
    {
        $this->freeIndexIsRandom = true;

        $roundToBuild = 2;
        $map = $this->getMap();
        $center = $map->getAllTiles()[$index];
        $centerX = $center[0][0];
        $centerY = $center[0][1];
        $position = new Tile($centerX, $centerY);

        $tileIndex = $map->getTileIndexByCoordinate($centerX, $centerY);
        $map->setTileDistance($tileIndex, 0);

        for ($i = 1; $i <= $roundToBuild; $i++) {
            $position->move(Directions::RIGHT_UP);

            foreach (Directions::getDirections() as $direction) {
                for ($j = 0; $j < $i; $j++) {
                    $moved = $position->move($direction);
                    $x = $moved->getCoordinates()[0];
                    $y = $moved->getCoordinates()[1];
                    $tile = new Tile($x, $y);
                    $tileNotExists = !$map->hasTile($tile);
                    if ($tileNotExists) {
                        $map->addTile(new Tile($x, $y), $i);
                    } else {
                        if ($i == 1) {
                            $isEdgeTile = $map->getTileDistanceByCoordinate($x, $y) == 2;
                            if ($isEdgeTile) {
                                $newTileIndex = $map->getTileIndexByCoordinate($x, $y);
                                $map->setTileDistance($newTileIndex, 1);
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
