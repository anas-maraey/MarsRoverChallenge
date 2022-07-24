<?php

namespace Domain\Vehicle\Rover;

use Domain\Common\Direction;
use Domain\Vehicle\Vehicle;
use Domain\Vehicle\VehicleBuilderInterface;
use Exceptions\InvalidCoordinates;
use Exceptions\InvalidDirection;
use Service\ValidationService;

class RoverBuilder implements vehicleBuilderInterface
{
    private ?Rover $rover;

    /**
     * @return void
     */
    public function createVehicle(): void
    {
        $this->rover = new Rover();
    }

    /**
     * @param array $coordinatesCandidate
     * @return void
     * @throws InvalidCoordinates
     */
    public function setCoordinates(array $coordinatesCandidate): void
    {
        $roverCoordinates = ValidationService::validateCoordinates($coordinatesCandidate);

        $this->rover->setCoordinates($roverCoordinates);
    }

    /**
     * @param string $directionCandidate
     * @return void
     * @throws InvalidDirection
     */
    public function setDirection(string $directionCandidate): void
    {
        $roverDirection = Direction::tryFrom($directionCandidate);

        if (! $roverDirection) {
            throw new InvalidDirection();
        }

        $this->rover->setDirection($roverDirection);
    }

    /**
     * @return Vehicle|null
     */
    public function getVehicle(): ?Vehicle
    {
        return $this->rover;
    }
}
