<?php

namespace Command;

use Domain\Vehicle\Rover\Rover;

interface Command
{
    /**
     * @param Rover $rover
     * @return Rover
     */
    public function execute(Rover $rover): Rover;
}
