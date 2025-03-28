<?php

namespace App\Domain\Cart\Exceptions;

use Exception;

class OutOfStockException extends Exception
{
    public function __construct($message = "Some products are out of stock", $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}