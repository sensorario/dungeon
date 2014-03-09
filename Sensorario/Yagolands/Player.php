<?php

namespace Sensorario\Yagolands;

class Player
{
    private $world;

    public function __construct(World $world)
    {
        $this->world = $world;
    }

    public function getWorldName()
    {
        return $this->world->getName();
    }
}
