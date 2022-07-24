<?php

require 'vendor/autoload.php';

use Command\CommandFactory;
use Domain\Plateau\Plateau;
use Domain\Vehicle\Rover\Rover;
use Domain\Vehicle\Rover\RoverBuilder;
use Domain\Vehicle\VehicleDirector;
use Exceptions\CantMove;
use Exceptions\InvalidCoordinates;
use Exceptions\InvalidOrder;
use Service\ValidationService;

/**
 * @return Plateau|null
 * @throws InvalidCoordinates
 */
function setPlateau(): ?Plateau
{
    $userInput = trim(readline("Plateau most right-upper coordinates (separated by space): "));
    $plateauMaxPoint = ValidationService::validateCoordinates(explode(' ', $userInput));

    return Plateau::getInstance($plateauMaxPoint);
}

/**
 * @return Rover
 */
function createRover(): Rover
{
    $userInput = trim(readline("Rover position and direction (ex: 5 5 N): "));

    preg_match_all('/\d+/', $userInput, $coordinatesCandidate);
    $directionCandidate = preg_replace('/[^A-Z]/', '', $userInput);

    $roverBuilder = new RoverBuilder();

    return (new VehicleDirector())
        ->build($roverBuilder, $coordinatesCandidate[0], $directionCandidate);
}

/**
 * @return array|null
 * @throws InvalidOrder
 */
function getNavigationOrders(): ?array
{
    $userInput = trim(readline("Please provide navigation commands (ex: LRMMLLRM): "));
    $navigationOrders = ValidationService::validateNavigationOrders(str_split($userInput));

    return $navigationOrders;
}

/**
 * @param Rover $rover
 * @return void
 */
function printResult(Rover $rover): void
{
    $xAxis = $rover->getCoordinates()->getX();
    $yAxis = $rover->getCoordinates()->getY();
    $direction = $rover->getDirection()->value;

    echo "\e[38;5;82mRover Position: " . $xAxis . " " . $yAxis . " " . $direction ;
    echo "\n";
}

/**
 * @throws InvalidCoordinates
 * @throws InvalidOrder
 * @throws CantMove
 */
function main(): void
{
    $plateau = setPlateau();
    $rover = createRover();
    $navigationOrders = getNavigationOrders();

    foreach ($navigationOrders as $order) {
        $command = CommandFactory::create($rover, $plateau, $order);
        if(! $command) {
            throw new CantMove();
        }

        $command->execute($rover);
    }

    printResult($rover);
}

try {
    main();
} catch (Exception $e) {
    echo "\e[91mException: " . $e->getMessage()  . "\n";
}