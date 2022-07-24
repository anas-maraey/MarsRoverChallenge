<?php

namespace Exceptions;

use Exception;

class CantMove extends Exception
{
    protected $message = "Rover can't move";
}