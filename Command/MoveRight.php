<?php

namespace Command;

use Domain\Common\Direction;
use Domain\Vehicle\Rover\Rover;

class MoveRight implements Command
{
    /**
     * @param Rover $rover
     * @return Rover
     */
    public function execute(Rover $rover): Rover
    {
        match ($rover->getDirection()) {
            Direction::NORTH => $rover->setDirection(Direction::EAST),
            Direction::EAST => $rover->setDirection(Direction::SOUTH),
            Direction::SOUTH => $rover->setDirection(Direction::WEST),
            Direction::WEST => $rover->setDirection(Direction::NORTH),
        };

        return $rover;
    }
}
