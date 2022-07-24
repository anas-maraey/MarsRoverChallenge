<?php

namespace Domain\Plateau;

use Domain\Common\Coordinates;

/***
 * @property Coordinates $maxPoint
 */
class Plateau
{
    private static $instance = null;

    /**
     * @param Coordinates $maxPoint
     */
    private function __construct(private Coordinates $maxPoint) {
    }

    /**
     * @param Coordinates $maxPoint
     * @return self
     */
    public static function getInstance(Coordinates $maxPoint): self
    {
        if (self::$instance === null)
        {
            self::$instance = new self($maxPoint);
        }

        return self::$instance;
    }

    /**
     * @return Coordinates
     */
    public function getMaxPoint(): Coordinates
    {
        return $this->maxPoint;
    }
}
