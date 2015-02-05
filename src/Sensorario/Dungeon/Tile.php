<?php

namespace Sensorario\Dungeon;

use JsonSerializable;

class Tile implements JsonSerializable
{
    protected $x;

    protected $y;

    public function __construct($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getCoordinates()
    {
        return [$this->x, $this->y];
    }

    public function move($direction)
    {
        switch ($direction) {
            case Directions::RIGHT_UP:
                return $this->moveRightUp();
            case Directions::RIGHT:
                return $this->moveRight();
            case Directions::LEFT:
                return $this->moveLeft();
            case Directions::LEFT_UP:
                return $this->moveLeftUp();
            case Directions::DOWN_RIGHT:
                return $this->moveRightDown();
            case Directions::DOWN_LEFT:
                return $this->moveLeftDown();
        }
    }

    private function moveRight()
    {
        ++$this->x;
        return $this;
    }

    private function moveLeft()
    {
        --$this->x;
        return $this;
    }

    private function moveRightUp()
    {
        $this->x = $this->x + 1 * ($this->y % 2 != 0);
        ++$this->y;
        return $this;
    }

    private function moveLeftUp()
    {
        $this->x = $this->x - 1 * ($this->y % 2 == 0);
        ++$this->y;
        return $this;
    }

    private function moveRightDown()
    {
        $this->x = $this->x + 1 * ($this->y % 2 != 0);
        --$this->y;
        return $this;
    }

    private function moveLeftDown()
    {
        $this->x = $this->x - 1 * ($this->y % 2 == 0);
        --$this->y;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'x' => $this->x,
            'y' => $this->y,
        ];
    }

    // TODO: still to test
    public function getX()
    {
        return $this->x;
    }

    // TODO: still to test
    public function getY()
    {
        return $this->y;
    }
}
