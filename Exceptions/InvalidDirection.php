<?php

namespace Exceptions;

use Exception;

class InvalidDirection extends Exception
{
    protected $message = "Provided direction is not valid";
}