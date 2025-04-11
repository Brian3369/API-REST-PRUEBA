<?php
require_once 'ProductController.php';

$method = $_SERVER[['REQUEST_METHOD']];
$controller = new ProductController();

switch ($method) {
    case 'GET':
        $controller->getAllProducts();
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