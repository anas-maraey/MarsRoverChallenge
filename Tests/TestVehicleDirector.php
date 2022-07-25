<?php

namespace Tests;

use Domain\Common\Direction;
use Domain\Vehicle\Rover\Rover;
use Domain\Vehicle\Rover\RoverBuilder;
use Domain\Vehicle\VehicleDirector;
use Exceptions\InvalidCoordinates;
use PHPUnit\Framework\TestCase;

final class TestVehicleDirector extends TestCase
{
    /**
     * @return void
     */
    public function testCanBuildRover(): void
    {
        $coordinates = [1, 2];
        $direction = Direction::NORTH->value;

        $roverBuilder = new RoverBuilder();
        $newVehicle = (new VehicleDirector())->build($roverBuilder, $coordinates, $direction);

        $this->assertInstanceOf(Rover::class, $newVehicle);
    }

    /**
     * @return void
     */
    public function testCantBuildRover(): void
    {
        $coordinates = [1];
        $direction = Direction::NORTH->value;
        $roverBuilder = new RoverBuilder();

        $this->expectException(InvalidCoordinates::class);

        (new VehicleDirector())->build($roverBuilder, $coordinates, $direction);
    }
}
