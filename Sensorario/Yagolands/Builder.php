<?php

namespace Sensorario\Yagolands;

use DateTime;
use Sensorario\Yagolands\Building\Building\Building;

class Builder
{
    private $secondsToNextLevel;

    public function addToBuildPlan(Building $building)
    {
        $this->secondsToNextLevel = 0;
        foreach ($building->getBaseResources() as $quantity) {
            $this->secondsToNextLevel += $quantity;
        }
    }

    public function willEndJobAt()
    {
        return new DateTime("+{$this->secondsToNextLevel} seconds");
    }
}
