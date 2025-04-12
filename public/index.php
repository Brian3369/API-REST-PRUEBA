<?php
require_once '../src/ProductController.php';

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];
$controller = new ProductController();

switch ($method) {
    case 'GET':
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        
        if ($json && isset($data['id'])) {
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