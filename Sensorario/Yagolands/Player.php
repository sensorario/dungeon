<?php

namespace Sensorario\Yagolands;

class Player
{
    private $world;

    public function getWorld()
    {
        return $this->world;
    }

    public function setWorld(World $world)
    {
        $this->world = $world;
    }
}
