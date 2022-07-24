<?php

namespace Exceptions;

use Exception;

class InvalidCoordinates extends Exception
{
    protected $message = "Invalid values provided for coordinates";
}