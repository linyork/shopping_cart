<?php

namespace App\Exceptions;

use Exception;

class ProductException extends Exception
{
    public function report()
    {
        // do something
    }

    public function render()
    {
        abort(403, $this->getMessage());
    }
}