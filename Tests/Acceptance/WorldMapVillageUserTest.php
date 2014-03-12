<?php

namespace Tests\Acceptance;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Player;
use Sensorario\Yagolands\Village;
use Sensorario\Yagolands\World;

class WorldMapVillageUserTest extends PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $world = new World('yagolands');
        $guest = new Player();
        $player = new Player();
        $village = new Village();

        $world->addPlayer($player);
        $player->setWorld($world);
        $village->setOwner($player);

        $this->assertEquals($player->getWorld(), $world);
        $this->assertTrue(true === $world->hasPlayer($player));
        $this->assertTrue(false === $world->hasPlayer($guest));
    }
}
