<?php

namespace Sensorario\Yagolands;

class Map
{
    private $tiles;

    public function __construct(Tile $coordinate, $rounds)
    {
        $this->tiles[] = $coordinate->getCoordinates();

        for ($i = 1; $i < $rounds; $i++) {
            $coordinate->move(Directions::RIGHT_UP);

            foreach (Directions::getDirections() as $direction) {
                for ($j = 0; $j < $i; $j++) {
                    $this->tiles[] = $coordinate->move($direction)->getCoordinates();
                }
            }
        }
    }

    public function getTilesCoordinate()
    {
        return $this->tiles;
    }
}
