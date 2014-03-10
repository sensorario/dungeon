<?php

namespace Sensorario\Yagolands;

class World
{
    private $name;

    private $map;

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

    public function buildAroundAnIndex($index)
    {
    }
}
