<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Utility;

use \Exception;

class DatabaseException extends Exception{
    
    //Non default constructor
    public function __construct($message, $code = 0, Exception $previous = null){
        //Call super constructor
        parent::__construct($message, $code, $previous);
    }
}