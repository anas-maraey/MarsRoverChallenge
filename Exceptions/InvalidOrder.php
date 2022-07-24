<?php

namespace Exceptions;

class InvalidOrder extends \Exception
{
    protected $message = "Invalid navigation order provided";
}