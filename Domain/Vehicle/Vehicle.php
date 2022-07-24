<?php

namespace Domain\Vehicle;

use Domain\Common\Coordinates;
use Domain\Common\Direction;

class Vehicle
{
    /**
     * @param Coordinates|null $coordinates
     * @param Direction|null $direction
     */
    public function __construct(
        private ?Coordinates $coordinates = null,
        private ?Direction $direction= null
    ) {
    }

    /**
     * @param Coordinates $coordinates
     * @return void
     */
    public function setCoordinates(Coordinates $coordinates): void
    {
        $this->coordinates = $coordinates;
    }

    /**
     * @return Coordinates
     */
    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    /**
     * @param Direction $direction
     * @return void
     */
    public function setDirection(Direction $direction): void
    {
        $this->direction = $direction;
    }

    /**
     * @return Direction
     */
    public function getDirection(): Direction
    {
        return $this->direction;
    }

}