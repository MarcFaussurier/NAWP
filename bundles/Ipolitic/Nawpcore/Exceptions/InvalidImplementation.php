<?php
/**
 * Created by PhpStorm.
 * User: fauss
 * Date: 10/31/2018
 * Time: 6:24 PM
 */

namespace App\Ipolitic\Nawpcore\Exceptions;


use Throwable;

class InvalidImplementation extends Exception
{
    public function __construct(string $message = "Incompatible implementation given to factory.", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}