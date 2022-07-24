<?php

namespace Domain\Common;

enum Order: string
{
    case FORWARD = 'M';
    case LEFT = 'L';
    case RIGHT = 'R';
}