<?php

namespace Sensorario\Yagolands;

class Tile
{
    private $x;

    private $y;

    private $owner;

    private $isBuildable;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        $this->isBuildable = $x + $y > 0;
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
        $this->x += $this->y % 2;
        ++$this->y;
        return $this;
    }

    private function moveLeftUp()
    {
        $this->x -= $this->y % 2 == 0;
        ++$this->y;
        return $this;
    }

    private function moveRightDown()
    {
        $this->x += $this->y % 2 == 1;
        --$this->y;
        return $this;
    }

    private function moveLeftDown()
    {
        $this->x -= $this->y % 2 == 0;
        --$this->y;
        return $this;
    }

    public function hasOwner()
    {
        return $this->owner != null;
    }

    public function setOwner(Player $player)
    {
        $this->owner = $player;
    }

    public function isBuildable()
    {
        return $this->isBuildable;
    }
}
