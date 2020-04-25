<?php

/*
 * Brady Berner & Pengyu Yin
 * CST-256
 * 3-17-19
 * This assignment was completed in collaboration with Brady Berner, Pengyu Yin
 */

namespace App\Services\Business;

use App\Services\Utility\Connection;
use App\Services\Data\UserDAO;
use App\Models\UserModel;

class UserService{
    
    //Takes in an ID and gets the user associated with this ID
    public function findByID(int $id){
        
       
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new UserDAO($connection);
        
        //Stores results of the associated data acess object function call
        $results = $DAO->findByID($id);
        
        //Closes connection to the database
        $connection = null;
        
       
        
        //Returns the result obtained from the data access object
        return $results;
    }
    
    //Gets all of the users contained within the user table of the database
    public function getAllUsers(){
        
       
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new UserDAO($connection);
        
        //Stores the results of the data access object's get all method.
        $results = $DAO->getAll();
        
        //Closes the connection to the databse
        $connection = null;
        
        
        
        //Returns the results obtained from the data access object
        return $results;
    }
    
    //Takes a usermodel as an argument and sends it to the associated data access object function to edit the user passed
    public function editUser(UserModel $user){
        
       
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new UserDAO($connection);
        
        //Stores the results of the data access object's function call
        $results = $DAO->update($user);
        
        //Closes the connection to the database
        $connection = null;
        
        
        //Returns the results obtained from the data access object
        return $results;
    }
    
    //Takes an ID as an argument and attempts to remove the user associated with the ID from the database
    public function removeUser($id){

       
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new UserDAO($connection);
        
        //Stores the results of the data access object's function call
        $results = $DAO->remove($id);
        
        //Closes the connection to the database
        $connection = null;
        
        
        
        //Returns the results obtained from the data access object
        return $results;
    }
}