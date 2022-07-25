<?php

namespace Tests;

use Command\CommandFactory;
use Command\MoveForward;
use Command\MoveLeft;
use Command\MoveRight;
use Domain\Common\Coordinates;
use Domain\Common\Direction;
use Domain\Common\Order;
use Domain\Plateau\Plateau;
use Domain\Vehicle\Rover\Rover;
use Domain\Vehicle\Rover\RoverBuilder;
use Domain\Vehicle\VehicleDirector;
use PHPUnit\Framework\TestCase;

final class TestCommand extends TestCase
{
    /**
     * @return void
     */
    public function testCommandFactory(): void
    {
        $command = CommandFactory::create(rover: null, plateau: null, order: Order::LEFT);

        $this->assertInstanceOf(MoveLeft::class, $command);
    }

    /**
     * @dataProvider roverInstanceProvider
     * @param Rover $rover
     * @return void
     */
    public function testMoveRight(Rover $rover): void
    {
        $command = new MoveRight();
        $command->execute($rover);

        $this->assertEquals(Direction::EAST, $rover->getDirection());
    }

    /**
     * @dataProvider roverInstanceProvider
     * @param Rover $rover
     * @return void
     */
    public function testMoveLeft(Rover $rover): void
    {
        $command = new MoveLeft();
        $command->execute($rover);

        $this->assertEquals(Direction::WEST, $rover->getDirection());
    }

    /**
     * @dataProvider roverInstanceProvider
     * @param Rover $rover
     * @return void
     */
    public function testCanMoveForward(Rover $rover): void
    {
        $command = new MoveForward();
        $command->execute($rover);

        $this->assertEquals($rover->getCoordinates(), new Coordinates(1, 3));
    }

    /**
     * @dataProvider roverAndPlateauProvider
     * @param Rover $rover
     * @param Plateau $plateau
     * @return void
     */
    public function testCantMoveForward(Rover $rover, Plateau $plateau): void
    {
        $command = CommandFactory::create(rover: $rover, plateau: $plateau, order: Order::FORWARD);

        $this->assertNull($command);
    }

    /**
     * Provides the rover instance for testing MoveRight and MoveLeft commands
     *
     * @return array[]
     */
    private function roverInstanceProvider(): array
    {
        $roverBuilder = new RoverBuilder();
        $coordinates = [1, 2];

        return [
            [
                'rover' => (new VehicleDirector())
                    ->build($roverBuilder, $coordinates, 'N'),
            ],
        ];
    }

    /**
     * Provides the rover instance for testing MoveRight and MoveLeft commands
     *
     * @return array[]
     */
    private function roverAndPlateauProvider(): array
    {
        $roverBuilder = new RoverBuilder();
        $coordinates = [5, 5];

        return [
            [
                'rover' => (new VehicleDirector())
                    ->build($roverBuilder, $coordinates, 'N'),
                'plateau' => Plateau::getInstance(new Coordinates(5, 5)),
            ],
        ];
    }

}