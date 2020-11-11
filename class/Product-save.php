<?php
namespace Phppot;

use \Phppot\DataSource;

class Products_save
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function saveProducts($name, $reference, $price, $weight, $category, $stock)
    {  
        $dateregister = date("Y-m-d h:i:s"); 
        $query = "INSERT INTO products (name, reference, price, weight, category, stock, creation_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $paramType = "ssiisii";
        $paramArray = array($name, $reference, $price, $weight, $category, $stock, $dateregister);
        $ProductsResult = $this->ds->insert($query, $paramType, $paramArray);
        return $ProductsResult;
    }

}

$information = json_decode($_POST["information"]);
$product_save = new Products_save();
echo $product_save->saveProducts($information->name, $information->reference, $information->price, $information->weight, $information->category, $information->stock);
 