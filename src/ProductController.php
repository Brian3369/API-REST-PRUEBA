<?php
require_once '../config/database.php';
require_once '../src/Product.php';

class ProductController{
    private $db;
    private $product;

    public function __construct(){
        $datbase = new Database();
        $this->db = $datbase->getConnection();
        $this->product = new Product($this->db);
    }

    public function getAllProducts() {

    }

    public function createProduct(){

    }

    public function updateProduct(){

    }

    public function deleteProduct(){

    }
}
?>