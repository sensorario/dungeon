<?php

namespace Sensorario\Dungeon;

use Sensorario\Dungeon\VillageCannotGrowException;

class Village extends Dungeon
{
    private $coreIsBuilt;

    public function __construct()
    {
        $this->coreIsBuilt = false;
        parent::__construct(new Tile(0, 0), 3);
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
            throw new VillageCannotGrowException;
        }
    }
}
