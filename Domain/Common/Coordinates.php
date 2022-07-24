<?php

namespace Domain\Common;

/***
 * @property int $x
 * @property int $y
 */
class Coordinates
{
    public function __construct(
        private int $x,
        private int $y
    ) {
    }

    /**
     * @param int|null $x
     * @param int|null $y
     * @return void
     */
    public function changeCoordinates(?int $x = null, ?int $y = null): void
    {
        $this->x = $x ?? $this->x;
        $this->y = $y ?? $this->y;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }
}
