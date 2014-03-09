<?php

namespace Sensorario\Yagolands;

class Directions
{
    const RIGHT_UP = 'right_up';
    const RIGHT = 'right';
    const LEFT = 'left';
    const LEFT_UP = 'up_left';
    const DOWN_RIGHT = 'down_right';
    const DOWN_LEFT = 'down_left';

    public static function getDirections()
    {
        return [
            Directions::DOWN_RIGHT,
            Directions::DOWN_LEFT,
            Directions::LEFT,
            Directions::LEFT_UP,
            Directions::RIGHT_UP,
            Directions::RIGHT,
        ];
    }
}
