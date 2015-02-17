<?php
namespace Sensorario\Dungeon\Services;

use Sensorario\Dungeon\Tile as DungeonTile;
use Sensorario\Dungeon\Map as DungeonMap;

class DungeonMapService
{
    private $clientMap;

    private function __construct(array $tiles, DungeonMap $map)
    {
        foreach ($tiles as $tile) {
            $dungeonTile = new DungeonTile(
                $tile->getX(),
                $tile->getY()
            );

            $this->clientMap[$map->getTileIndex($dungeonTile)] = [];
            $this->clientMap[$map->getTileIndex($dungeonTile)] = [$dungeonTile];
        }
    }

    public static function createFromTilesAndMap(array $tiles, DungeonMap $map)
    {
        return new self($tiles, $map);
    }

    public function clientMap()
    {
        return $this->clientMap;
    }
}
