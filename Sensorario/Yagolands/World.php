<?php

namespace Sensorario\Yagolands;

class World
{
    private $name;

    private $map;

    private $freeIndexIsRandom = false;

    const DISTANCE = 1;

    const IS_ON_THE_EDGE = 2;

    const COORDINATES = 0;

    const X = 0;

    const Y = 1;

    const FIRST_ROUND = 1;

    public function __construct($name)
    {
        $this->name = $name;
        $this->map = new Map(new Tile(self::COORDINATES, self::COORDINATES), 3);
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
                $rand = rand(self::COORDINATES, count($tiles) - self::DISTANCE);
                if ($tiles[$rand][self::DISTANCE] == self::IS_ON_THE_EDGE) {
                    return $rand;
                }
            }
        }

        foreach ($tiles as $index => $tile) {
            if ($tile[self::DISTANCE] == self::IS_ON_THE_EDGE) {
                return $index;
            }
        }
    }

    public function growAroundEdgeTile($index)
    {
        $this->freeIndexIsRandom = true;

        $roundToBuild = self::IS_ON_THE_EDGE;
        $map = $this->getMap();
        $center = $map->getAllTiles()[$index];
        $centerX = $center[self::COORDINATES][self::X];
        $centerY = $center[self::COORDINATES][self::Y];
        $position = new Tile($centerX, $centerY);

        $tileIndex = $map->getTileIndexByCoordinate($position);
        $map->setTileDistance($tileIndex, self::COORDINATES);

        for ($round = self::DISTANCE; $round <= $roundToBuild; $round++) {
            $position->move(Directions::RIGHT_UP);

            foreach (Directions::getDirections() as $direction) {
                for ($j = self::COORDINATES; $j < $round; $j++) {
                    $moved = $position->move($direction);
                    $x = $moved->getCoordinates()[self::X];
                    $y = $moved->getCoordinates()[self::Y];
                    $tile = new Tile($x, $y);
                    $tileNotExists = !$map->hasTile($tile);
                    if ($tileNotExists) {
                        $map->addTile(new Tile($x, $y), $round);
                    } else {
                        if ($round == self::FIRST_ROUND) {
                            if ($map->getTileDistanceByCoordinate($moved) == self::IS_ON_THE_EDGE) {
                                $newTileIndex = $map->getTileIndexByCoordinate($moved);
                                $map->setTileDistance($newTileIndex, self::DISTANCE);
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
