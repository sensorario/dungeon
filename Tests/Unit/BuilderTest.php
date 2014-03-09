<?php

namespace Tests\Unit;

use PHPUnit_Framework_TestCase;
use Sensorario\Yagolands\Builder;
use Sensorario\Yagolands\Resources;

class BuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider buildings
     */
    public function testTimeToBuild($buildingClass, $resources, $seconds)
    {
        $builder = new Builder();

        $building = $this->getMockBuilder($buildingClass)
            ->setMethods(['getBaseResources'])
            ->getMock();
        $building->expects($this->once())
            ->method('getBaseResources')
            ->will($this->returnValue($resources));

        $builder->addToBuildPlan($building);
        $this->assertEquals(new \DateTime("+{$seconds} seconds"), $builder->willEndJobAt());
    }

    public function buildings()
    {
        return [
            [
                'Sensorario\Yagolands\Building\Barrack',
                [
                    Resources::GRANO => 35,
                    Resources::FERRO => 43,
                    Resources::ARGILLA => 39,
                    Resources::WOOD => 41,
                ],
                158
            ],
            [
                'Sensorario\Yagolands\Building\Castle',
                [
                    Resources::GRANO => 33,
                    Resources::FERRO => 42,
                    Resources::ARGILLA => 37,
                    Resources::WOOD => 40,
                ],
                152
            ],
        ];
    }
}
