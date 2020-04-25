<?php


namespace App\Services\Business;

use App\Models\UserModel;
use App\Services\Utility\Connection;
use PDO;
use App\Services\Data\UserDAO;
use App\Services\Utility\DatabaseException;

class SecurityService
{

    // Function takes user as an argument and calls the database registration service with that user then returns
    // the result it gets
    public function register(UserModel $user)
    {
      

        try{
        $connection = new Connection();
        $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        $connection->beginTransaction();

        $DAO = new UserDAO($connection);

        $result = $DAO->create($user);

        $connection->commit();
        $connection = null;
        
        } catch (\Exception $e){
            
            $connection->rollBack();
            throw new DatabaseException("Exception: " . $e->getMessage(), 0, $e);
        }

       

        return $result;
    }

    // Function takes user as an argument and calls the database login service and returns the result
    public function login(UserModel $user)
    {
      

        $connection = new Connection();

        $DAO = new UserDAO($connection);

        $connection = null;

        $result = $DAO->findByLogin($user);

      
        
        return $result;
    }
}