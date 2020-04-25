<?php


namespace App\Models;

class ProductModel
{
    //Attributes corresponding to the data stored in the database for all entries of the corresponding table
    private $id;
    private $name;
    private $price;
    private $quantity;
    private $description;
    
    //Sets all attributes equal to the corresponding value passed to the constructor
    function __construct($id,$name,$price,$quantity,$description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->description = $description;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

}