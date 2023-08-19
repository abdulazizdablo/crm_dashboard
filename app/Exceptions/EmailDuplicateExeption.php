<?php

namespace App\Exceptions;

use Exception;

class EmailDuplicateExeption extends Exception
{
     protected $code = 1062;


    public function getCode(){

        return $this->code;
    }
}
