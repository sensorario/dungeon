<?php

namespace Sensorario\Yagolands\Building;

use Sensorario\Yagolands\Resources;

class Castle extends Building
{
    protected function getBaseResources()
    {
        return [
            Resources::GRANO => 33,
            Resources::FERRO => 42,
            Resources::ARGILLA => 37,
            Resources::WOOD => 40,
        ];
    }
}
