<?php
namespace Phppot;

use \Phppot\DataSource;

class Products_Delete
{

    private $dbConn;

    private $ds;

    function __construct()
    {
        require_once "DataSource.php";
        $this->ds = new DataSource();
    }

    function deleteProduct($id)
    {  
        $query = "DELETE FROM products WHERE id = ?";
        $paramType = "i";
        $paramArray = array($id);
        $ProductsResult = $this->ds->simpleDelete($query, $paramType, $paramArray);
        return 1;
    }

}

$id = $_POST["id"];
$product_save = new Products_Delete();
echo $product_save->deleteProduct($id);
 