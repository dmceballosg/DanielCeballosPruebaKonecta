<?php
namespace Phppot;

use \Phppot\DataSource;

class ProductsEdit
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function editProducts($id, $name, $reference, $price, $weight, $category, $stock)
    {  
        $query = "UPDATE products SET (name, reference, price, weight, category, stock) VALUES (?, ?, ?, ?, ?, ?, ?) WHERE id = ?";
        $paramType = "ssiisiii";
        $paramArray = array($name, $reference, $price, $weight, $category, $stock, $dateregister, $id);
        $ProductsResult = $this->ds->update($query, $paramType, $paramArray);
        return $ProductsResult;
    }

}

$information = json_decode($_POST["information"]);
$product_edit = new ProductsEdit();
echo $product_edit->editProducts($information->name, $information->reference, $information->price, $information->weight, $information->category, $information->stock);
 