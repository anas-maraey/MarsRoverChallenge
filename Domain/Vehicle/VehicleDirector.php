<?php

namespace Domain\Vehicle;

class VehicleDirector
{
    /**
     * @param vehicleBuilderInterface $builder
     * @param array $coordinates
     * @param string $direction
     * @return Vehicle
     */
    public function build(vehicleBuilderInterface $builder, array $coordinates, string $direction): Vehicle
    {
        $builder->createVehicle();
        $builder->setCoordinates($coordinates);
        $builder->setDirection($direction);

        return $builder->getVehicle();
    }
}
