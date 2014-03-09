<?php

namespace Sensorario\Yagolands\Building;

use Sensorario\Yagolands\Resources;

class Barrack extends Building
{
    protected function getBaseResources()
    {
        return [
            Resources::GRANO => 35,
            Resources::FERRO => 43,
            Resources::ARGILLA => 39,
            Resources::WOOD => 41,
        ];
    }
}
