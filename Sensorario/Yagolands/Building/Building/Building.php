<?php

namespace Sensorario\Yagolands\Building\Building;

abstract class Building
{
    public function resourceToNextLevel($resource, $level = 1)
    {
        $return = $this->getBaseResources()[$resource];

        for ($i = 1; $i < $level; $i++) {
            $return *= 1.3;
        }

        return ceil($return);
    }

    abstract public function getBaseResources();
}
