<?php

namespace Sensorario\Yagolands\Building\Building;

abstract class Building
{
    public function resourceForLevel($resource, $level)
    {
        $return = $this->getBaseResources()[$resource];

        for ($i = 1; $i < $level; $i++) {
            $return *= 1.3;
        }

        return ceil($return);
    }

    abstract public function getBaseResources();
}
