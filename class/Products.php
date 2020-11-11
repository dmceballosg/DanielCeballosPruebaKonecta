<?php
namespace Phppot;

use \Phppot\DataSource;

class Products
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function getAllProducts()
    {
        $query = "select * FROM products";
        $ProductsResult = $this->ds->simpleSelect($query);
        return $ProductsResult;
    }

}

$product = new Products();
echo  json_encode($product->getAllProducts());