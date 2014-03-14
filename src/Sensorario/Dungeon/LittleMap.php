<?php

namespace Sensorario\Dungeon;

use JsonSerializable;

class LittleMap extends Dungeon implements JsonSerializable
{
    private $coreIsBuilt;

    public function __construct(Tile $position = null, $rounds = 3)
    {
        if (!$position) {
            $position = new Tile(0, 0);
        }

        $this->coreIsBuilt = false;
        parent::__construct($position, $rounds);
        $this->coreIsBuilt = true;
    }

    public function coreIsBuilt()
    {
        return $this->coreIsBuilt;
    }

    public function addTile(Tile $tile, $distance = 0)
    {
        $coreIsNotYetBuilt = !$this->coreIsBuilt;
        if ($coreIsNotYetBuilt) {
            $this->tiles[] = [$tile->getCoordinates(), $distance];
        } else {
            throw new LittleMapCannotGrowException();
        }
    }

    public function countTiles()
    {
        return count($this->getAllTiles());
    }

    public function jsonSerialize()
    {
        return [
            'tiles' => $this->getAllTiles()
        ];
    }
}
