<?php

namespace Sensorario\Dungeon;

class World
{
    private $name;

    private $map;

    private $freeIndexSearchIsRandom = false;

    const DISTANCE = 1;

    const IS_ON_THE_EDGE = 2;

    const COORDINATES = 0;

    const X = 0;

    const Y = 1;

    const FIRST_ROUND = 1;

    public function __construct($name)
    {
        $this->name = $name;
        $this->map = new Map(Tile::withCoords(0, 0), 3);
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

    public function getEdgeTile()
    {
        $tiles = $this->getMap()->getAllTiles();

        if ($this->freeIndexSearchIsRandom) {
            while (true) {
                $rand = rand(self::COORDINATES, count($tiles) - 1);
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

    public function growAroundTile($index)
    {
        $this->freeIndexSearchIsRandom = true;

        $roundToBuild = 2;
        $map = $this->getMap();

        $position = Tile::withCoords(
            $map->getAllTiles()[$index][self::COORDINATES][self::X],
            $map->getAllTiles()[$index][self::COORDINATES][self::Y]
        );

        $map->setTileDistance($index, self::COORDINATES);

        for ($round = self::DISTANCE; $round <= $roundToBuild; $round++) {
            $position->move(Directions::RIGHT_UP);

            foreach (Directions::getDirections() as $direction) {
                for ($step = 0; $step < $round; $step++) {
                    $tile = $position->move($direction);
                    if ($map->hasTile($tile)) {
                        if ($round == self::FIRST_ROUND) {
                            if ($map->isTileOnTheEdge($tile)) {
                                $newTileIndex = $map->getTileIndex($tile);
                                $map->setTileDistance($newTileIndex, self::DISTANCE);
                            }
                        }
                    } else {
                        $map->addTile($tile, $round);
                    }
                }
            }
        }
    }

    public function freeIndexSearchIsRandom()
    {
        return $this->freeIndexSearchIsRandom;
    }
}
