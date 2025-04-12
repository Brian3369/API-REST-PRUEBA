<?php
require_once '../src/ProductController.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');

$method = $_SERVER['REQUEST_METHOD'];
$controller = new ProductController();

switch ($method) {
    case 'GET':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if (!$id) {
            $controller->getProductByID();
        } else {
            $controller->getAllProducts();
        }
        break;
    case 'POST':
        $controller->createProduct();
        break;
    case 'PUT':
        $controller->updateProduct();
        break;
    case 'DELETE':
        $controller->deleteProduct();
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
}
?>