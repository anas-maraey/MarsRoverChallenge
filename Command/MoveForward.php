<?php

namespace Command;

use Domain\Common\Direction;
use Domain\Vehicle\Rover\Rover;

class MoveForward implements Command
{
    /**
     * @param Rover $rover
     * @return Rover
     */
    public function execute(Rover $rover): Rover
    {
        $coordinates = $rover->getCoordinates();

        match ($rover->getDirection()) {
            Direction::NORTH => $coordinates->changeCoordinates(y: $coordinates->getY() + 1),
            Direction::EAST => $coordinates->changeCoordinates(x: $coordinates->getX() + 1),
            Direction::SOUTH => $coordinates->changeCoordinates(y: $coordinates->getY() - 1),
            Direction::WEST => $coordinates->changeCoordinates(x: $coordinates->getX() - 1),
        };

        $rover->setCoordinates($coordinates);

        return $rover;
    }
}
