<?php
class Product{
    private $conn;
    private $table_name = "productos";
    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $creado_en;

    public function __construct($db){
        $this->conn = $db;
    }

    public function createProduct(){
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion, precio=:precio, creado_en= NOW()";
        $stmt = $this->conn->prepare($query);

        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAllProducts(){
        $query = "select * from " . $this->table_name;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function getProductByID(){
        $query = "select * from " . $this->table_name . " where id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }

    public function updateProduct(){
        $query = "update " . $this->table_name . " set nombre = :nombre, descripcion = :descripcion, precio = :precio where id=:id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteProduct(){
        $query = "delete from " . $this->table_name . " where id = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
}
?>