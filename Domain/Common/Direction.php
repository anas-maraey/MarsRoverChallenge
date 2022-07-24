<?php

namespace Domain\Common;

enum Direction: string
{
    case NORTH = 'N';
    case SOUTH = 'S';
    case EAST = 'E';
    case WEST = 'W';
}
