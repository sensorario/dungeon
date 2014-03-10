<?php

namespace Sensorario\Yagolands;

class Map
{
    private $tiles;

    public function __construct(Tile $coordinate, $rounds)
    {
        $distance = 0;

        $this->tiles[] = [
            $coordinate->getCoordinates(),
            $distance
        ];

        for ($i = 1; $i < $rounds; $i++) {
            $coordinate->move(Directions::RIGHT_UP);
            $distance += 1;

            foreach (Directions::getDirections() as $direction) {
                for ($j = 0; $j < $i; $j++) {
                    $moved = $coordinate->move($direction);
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
}
