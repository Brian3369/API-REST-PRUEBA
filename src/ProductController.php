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

    public function createProduct(){
        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->nombre) && isset($data->descripcion) && isset($data->precio)){
            $this->product->nombre = $data->nombre;
            $this->product->descripcion = $data->descripcion;
            $this->product->precio = $data->precio;

            if($this->product->createProduct()){
                http_response_code(201);
                echo json_encode(["message" => "Producto creado."]);

            }else{
                http_response_code(503);
                echo json_encode(["message" => "Error al crear el producto."]);
            }
        }else{
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos."]);
        }
    }

    public function getAllProducts() {
        $data = $this->product->getAllProducts();
        $registros = array();
        $registros['registros'] = $data;

        if($data){
            http_response_code(200);
            echo json_encode($registros);
        }else{
            http_response_code(404);
            echo json_encode(["message" => "No se encontraron productos."]);
        }
    }

    public function getProductByID(){
        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id)){
            $this->product->id = $data->id;
            $data = $this->product->getProductByID();

            if($data){
                http_response_code(200);
                echo json_encode($data);
            }else{
                http_response_code(404);
                echo json_encode(["message" => "Producto no encontrado."]);
            }
        }else{
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos."]);
        }
    }

    public function updateProduct(){
        $data = json_decode(file_get_contents("php://input"));
        if(isset($data->id) && isset($data->nombre) && isset($data->descripcion) && isset($data->precio)){
            $this->product->id = $data->id;
            $this->product->nombre = $data->nombre;
            $this->product->descripcion = $data->descripcion;
            $this->product->precio = $data->precio;

            if($this->product->updateProduct()){
                http_response_code(200);
                echo json_encode(["message" => "Producto actualizado."]);
            }else{
                http_response_code(503);
                echo json_encode(["message" => "Error al actualizar el producto."]);
            }
        }else{
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos."]);
        }

    }

    public function deleteProduct(){
        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id)){
            $this->product->id = $data->id;

            if($this->product->deleteProduct()){
                http_response_code(200);
                echo json_encode(["message" => "Producto eliminado."]);
            }else{
                http_response_code(503);
                echo json_encode(["message" => "Error al eliminar el producto."]);
            }
        }else{
            http_response_code(400);
            echo json_encode(["message" => "Datos incompletos."]);
        }
    }
}
?>