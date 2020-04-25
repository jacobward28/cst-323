<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Utility;

use Illuminate\Support\Facades\Log;
use PDO;
use Exception;

class Connection extends \PDO{
    
    //Calls super constructor with database information stored within the configuration file
    function __construct(){
        try{
            $servername = '127.0.0.1:55624';
            $username = 'azure';
            $password = '6#vWHD_$';
            $dbname = 'clc-cst-323';
            
            //Calls PDO constructor with the config file information
            parent::__construct("mysql:host=$servername;dbname=$dbname", $username, $password);
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e){
            Log::error("Exception: ", array("message" => $e->getMessage()));
        }
    }
}