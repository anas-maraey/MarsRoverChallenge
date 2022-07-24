<?php

namespace Domain\Vehicle;

interface vehicleBuilderInterface
{
    /**
     * @return void
     */
    public function createVehicle(): void;

    /**
     * @param array $coordinatesCandidate
     * @return void
     */
    public function setCoordinates(array $coordinatesCandidate): void;

    /**
     * @param string $directionCandidate
     * @return void
     */
    public function setDirection(string $directionCandidate): void;

    /**
     * @return Vehicle|null
     */
    public function getVehicle(): ?Vehicle;
}
