<?php

namespace Tests\Unit;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Player;

class PlayerTest extends PHPUnit_Framework_TestCase
{
    public function testPlayer()
    {
        $world = $this->getMockBuilder('Sensorario\Yagolands\World')
            ->disableOriginalConstructor()
            ->setMethods(['getName'])
            ->getMock();
        $world->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('yagolands'));

        $player = new Player($world);
        $this->assertEquals('yagolands', $player->getWorldName());
    }
}
