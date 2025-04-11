<?php
class Product{
    private $conn;
    private $table_name = "products";
    public $id;
    public $name;
    public $description;
    public $price;

    public function __construct($db){
        $this->conn = $db;
    }

    public function createProduct(){
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name . " (name, description, price, creado_en) VALUES (:name, :description, :price, :creado_en)");

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->price = htmlspecialchars(strip_tags($this->price));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':creado_en', date('Y-m-d H:i:s'));

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAllProducts(){

    }

    public function updateProduct(){

    }

    public function deleteProduct(){

    }
}
?>