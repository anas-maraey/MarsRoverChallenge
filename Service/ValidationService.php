<?php

namespace Service;

use Domain\Common\Coordinates;
use Domain\Common\Order;
use Exceptions\InvalidOrder;
use Exceptions\InvalidCoordinates;

class ValidationService
{
    /**
     * @param array $coordinatesArr
     * @return Coordinates
     * @throws InvalidCoordinates
     */
    public static function validateCoordinates (array $coordinatesArr): Coordinates
    {
        if(count($coordinatesArr) !== 2) {
            throw new InvalidCoordinates();
        }

        foreach ($coordinatesArr as $component) {
            if (! is_numeric($component)) {
                throw new InvalidCoordinates();
            }
        }

        return new Coordinates($coordinatesArr[0], $coordinatesArr[1]);
    }

    /**
     * @param array $orders
     * @return array|null
     * @throws InvalidOrder
     */
    public static function validateNavigationOrders(array $orders): ?array
    {
        foreach ($orders as $order) {
            if(! $order = Order::tryFrom($order)) {
                throw new InvalidOrder();
            }
            $ordersArr[] = $order;
        }

        return $ordersArr ?? null;
    }
}