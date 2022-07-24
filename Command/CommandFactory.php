<?php

namespace Command;

use Domain\Common\Order;
use Domain\Common\Direction;
use Domain\Plateau\Plateau;
use Domain\Vehicle\Rover\Rover;

class CommandFactory
{
    /**
     * @param Rover|null $rover
     * @param Plateau|null $plateau
     * @param Order $order
     * @return Command|null
     */
    public static function create(?Rover $rover, ?Plateau $plateau, Order $order): ?Command
    {
        return match ($order) {
            Order::LEFT => new MoveLeft(),
            Order::RIGHT => new MoveRight(),
            Order::FORWARD => (self::canMove($rover, $plateau)) ? new MoveForward() : null,
        };
    }

    /**
     * @param Rover $rover
     * @param Plateau $plateau
     * @return bool
     */
    private static function canMove(Rover $rover, Plateau $plateau): bool

    {
        $roverPosition = $rover->getCoordinates();
        $plateauMaxPoint = $plateau->getMaxPoint();

        return match ($rover->getDirection()) {
            Direction::NORTH => $roverPosition->getY() < $plateauMaxPoint->getY(),
            Direction::EAST => $roverPosition->getX() < $plateauMaxPoint->getX(),
            Direction::SOUTH => $roverPosition->getY() > 0,
            Direction::WEST => $roverPosition->getX() > 0,
        };
    }

}