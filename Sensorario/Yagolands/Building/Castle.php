<?php

namespace Sensorario\Yagolands\Building;

use Sensorario\Yagolands\Building\Building\Building;
use Sensorario\Yagolands\Resources;

class Castle extends Building
{
    public function getBaseResources()
    {
        return [
            Resources::GRANO => 33,
            Resources::FERRO => 42,
            Resources::ARGILLA => 37,
            Resources::WOOD => 40,
        ];
    }
}
