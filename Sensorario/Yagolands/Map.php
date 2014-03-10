<?php

namespace Sensorario\Yagolands;

class Map
{
    private $tiles;

    public function __construct(Tile $center, $rounds)
    {
        $distance = 0;

        $this->tiles[] = [
            $center->getCoordinates(),
            $distance
        ];

        $position = $center;
        for ($i = 1; $i < $rounds; $i++) {
            $position->move(Directions::RIGHT_UP);
            $distance++;

            foreach (Directions::getDirections() as $direction) {
                for ($j = 0; $j < $i; $j++) {
                    $moved = $position->move($direction);
                    $this->tiles[] = [
                        $moved->getCoordinates(),
                        $distance
                    ];
                }
            }
        }
    }

    public function getTiles()
    {
        return $this->tiles;
    }

    public function setTileDistance($tile, $distance)
    {
        $this->tiles[$tile][1] = $distance;
    }
}
