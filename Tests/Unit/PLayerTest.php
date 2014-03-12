<?php

namespace Tests\Unit;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Player;

class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function testAddWorld()
    {
        $world = $this->getMockBuilder('Sensorario\Yagolands\World')
            ->disableOriginalConstructor()
            ->getMock();

        $player = new Player();
        $player->setWorld($world);
    }
}
