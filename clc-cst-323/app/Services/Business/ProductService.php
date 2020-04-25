<?php


namespace App\Services\Business;

use App\Models\ProductModel;
use App\Services\Utility\Connection;
use App\Services\Utility\DatabaseException;
use App\Services\Data\ProductDAO;

class ProductService
{

    /**
     * @param ProductModel $Product
     * @return array
     * @throws DatabaseException
     */
    public function newProduct(ProductModel $Product)
    {
       

        //Creates connection with the database
        $connection = new Connection();

        //Creates data access object instance
        $DAO = new ProductDAO($connection);

        //Stores the results of the data access object's new Product method
        $result = $DAO->create($Product);

        //Closes the connection to the database
        $connection = null;

       

        return $result;
    }

    /**
     * Gets a specific Product based off its ID
     * @param int $id The ID of the Product to be retrieved
     * @return array Associative array representing the Product returned from the database
     * @throws DatabaseException
     */
    public function getProduct($id){
        
       
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates an instance of the appropriate DAO
        $DAO = new ProductDAO($connection);
        
        //Stores the results of the dao method
        $results = $DAO->getByID($id);
        
        //Closes the connection to the database
        $connection = null;
        
        
        
        return $results;
    }

    /**
     * Gets all of the Products form the database
     * @return array An array containing all the Products in the database
     * @throws DatabaseException
     */
    public function getAllProducts(){
        

        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new ProductDAO($connection);
        
        //Stores the results of the data access object's get all method.
        $results = $DAO->getAll();
        
        //Closes the connection to the databse
        $connection = null;
        
        
        
        //Returns the results obtained from the data access object
        return $results;
    }
    
    public function editProduct(ProductModel $Product){
        
       
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new ProductDAO($connection);
        
        //Stores the results of the data access object's function call
        $results = $DAO->update($Product);
        
        //Closes the connection to the database
        $connection = null;
        
        
        
        //Returns the results obtained from the data access object
        return $results;
    }

    /**
     * Removes a Product posting from the database
     * @param int $id The ID of the Product to be removed from the database
     * @return boolean The result of whether or not the Product was removed from the database
     * @throws DatabaseException
     */
    public function removeProduct($id){
       
        
        //Creates connection with the database
        $connection = new Connection();
        
        //Creates data access object instance
        $DAO = new ProductDAO($connection);
        
        //Stores the results of the data access object's function call
        $results = $DAO->remove($id);
        
        //Closes the connection to the database
        $connection = null;
        
       
        
        //Returns the results obtained from the data access object
        return $results;
    }

  }