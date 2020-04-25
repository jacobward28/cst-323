<?php

namespace App\Services\Utility;

use Monolog\Logger;
use Monolog\Handler\LogglyHandler;
use App\Services\Utility\Ilogger;

class MyLogger2 implements ILogger
{
    private static $logger = null;
    
    static function getLogger()
    {
        if (self::$logger == null)
        {
            self::$logger = new Logger('loggly');
            self::$logger->pushHandler(new LogglyHandler('9918bfb1-c2a5-44a1-91aa-ec4903a4dbba/tag/milestone', Logger::DEBUG));
            self::$logger->addInfo("Info test from monolog");
        }
        return self::$logger;
    }
    
    public static function debug($message, $data=array())
    {
        self::getLogger()->addDebug($message, $data);
    }
    
    public static function info($message, $data=array())
    {
        self::getLogger()->addInfo($message, $data);
    }
    
    public static function warning($message, $data=array())
    {
        self::getLogger()->addWarning($message, $data);
    }
    
    public static function error($message, $data=array())
    {
        self::getLogger()->addError($message, $data);
    }
}