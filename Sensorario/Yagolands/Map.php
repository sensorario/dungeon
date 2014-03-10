<?php

namespace Sensorario\Yagolands;

class Map
{
    private $tiles;

    public function __construct(Tile $coordinate, $rounds)
    {
        $this->tiles[] = [
            $coordinate->getCoordinates(),
            $coordinate->isBuildable()
        ];

        for ($i = 1; $i < $rounds; $i++) {
            $coordinate->move(Directions::RIGHT_UP);

            foreach (Directions::getDirections() as $direction) {
                for ($j = 0; $j < $i; $j++) {
                    $moved = $coordinate->move($direction);
                    $this->tiles[] = [
                        $moved->getCoordinates(),
                        $moved->isBuildable()
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
