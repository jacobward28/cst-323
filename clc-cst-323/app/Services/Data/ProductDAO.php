<?php /** @noinspection SqlDialectInspection */


namespace App\Services\Data;

use App\Models\ProductModel;
use App\Services\Utility\DatabaseException;
use PDO;
use PDOException;

class ProductDAO{
    
    //Stores the connection that functions will use to access the database
    private $conn;
    
    
    //Takes in a PDO connection and sets the conn field equal to it
    public function __construct(PDO $conn){
        $this->conn = $conn;
      
    }

    /**
     * Gets a Product based off the ID passed to the function
     * @param int $id The ID of the Product to be retrieved from the database
     * @return array An associative array containing all of the values from the Product retrieved
     * @throws DatabaseException
     */
    public function getByID($id){
       
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM PRODUCTS WHERE IDPRODUCT = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e){
           
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
      

        //TODO:: return results in assoc array
        return ['Product' => $statement->fetch(PDO::FETCH_ASSOC)];
    }

    /**
     * @return array
     * @throws DatabaseException
     */
    public function getAll(){
       
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM PRODUCTS");
            $statement->execute();
        } catch (PDOException $e){
           
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        //Temporary array to hold all Product data
        $products = [];
        
        //Iterates over each Product gotten back from the database query
        while($Product = $statement->fetch(PDO::FETCH_ASSOC)){
            //Adds the associative array representing the currently iterated Product to the Products array
            array_push($products, $Product);
        }
        
       
        
        //Returns the completed Products array containing all of the Product associative arrays
        return $products;
    }

    /**
     * @param $id
     * @return array
     * @throws DatabaseException
     */
    public function findByID($id){
       
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM PRODUCTS WHERE IDPRODUCTS = :id");
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e){
           
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
      
        //Returns whether or not the query found anything and the user in the event that it did
        return ['result' => $statement->rowCount(), 'Product' => $statement->fetch(PDO::FETCH_ASSOC)];
    }

    /**
     * Gets all of the Products with names linked to the search string
     * @param string $name The search string that will be used for the query
     * @return array An array of all the Products that are linked to the search string
     * @throws DatabaseException
     */
    public function findByName($name){
        
       
        
        try{
            $statement = $this->conn->prepare("SELECT * FROM PRODUCTS WHERE PRODUCT_NAME LIKE :search");
            $statement->bindParam(':search', $name);
            $statement->execute();
        } catch (PDOException $e){
           
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
        $products = [];
        
        while($Product = $statement->fetch(PDO::FETCH_ASSOC)){
            array_push($products, $Product);
        }
        
        
        
        return $products;
    }
    

    /**
     * @param ProductModel $Product
     * @return array
     * @throws DatabaseException
     */
    public function create(ProductModel $Product){
       
        
        try{
            //Gets all of the information from the ProductModel passed as an argument
            $name = $Product->getName();
            $price = $Product->getPrice();
            $quantity = $Product->getQuantity();
            $description = $Product->getDescription();
            
            //statement to create new entry in the users table with passed information and a NULL primary key and default values for the role and status
            $statement = $this->conn->prepare("INSERT INTO `PRODUCTS` (`IDPRODUCT`, `PRODUCT_NAME`, `PRICE`, `QUANTITY`, `DESCRIPTION`) VALUES (NULL, :name, :price, :quantity, :description)");
            //Binds all of the usermodel information to their respective tokens
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':quantity', $quantity);
            $statement->bindParam(':description', $description);
            $statement->execute();
        } catch (PDOException $e){
           
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
      
        //Returns the result of the database query as well as the ID of the created user
        return ['result' => $statement->rowCount(), 'insertID' => $this->conn->lastInsertID()];
    }

    /**
     * @param ProductModel $Product
     * @return int
     * @throws DatabaseException
     */
    public function update(ProductModel $Product){
        
        
        try{
            //Gets all of the information from the ProductModel
            $id = $Product->getId();
            $name = $Product->getName();
            $price = $Product->getPrice();
            $quantity = $Product->getQuantity();
            $description = $Product->getDescription();
           
            
            $statement = $this->conn->prepare("UPDATE `PRODUCTS` SET `PRODUCT_NAME` = :name, `PRICE` = :price, `QUANTITY` = :quantity,`DESCRIPTION` = :description WHERE `IDPRODUCT` = :id");
            //Binds all of the information from the ProductModel to their respective query tokens
            $statement->bindParam(':name', $name);
            $statement->bindParam(':price', $price);
            $statement->bindParam(':quantity', $quantity);
            $statement->bindParam(':description', $description);
            
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e){
           
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
       
        //Returns the result of the query
        return $statement->rowCount();
    }

    /**
     * @param $id
     * @return int
     * @throws DatabaseException
     */
    public function remove($id){
       
        
        try{            
            $statement = $this->conn->prepare("DELETE FROM `PRODUCTS` WHERE `IDPRODUCT` = :id");
            //Binds the ID passed as an argument to the query
            $statement->bindParam(':id', $id);
            $statement->execute();
        } catch (PDOException $e){
           
            throw new DatabaseException("Database Exception: " . $e->getMessage(), 0, $e);
        }
        
       
        //Returns the result of the query
        return $statement->rowCount();
    }
}