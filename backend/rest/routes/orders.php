<?php
require_once __DIR__ . '/../services/OrderService.php';

$orderService = new OrderService();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode($orderService->getAllOrders());
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($orderService->createOrder($data));
        break;

    case 'PUT':
        parse_str($_SERVER['QUERY_STRING'], $params);
        $id = $params['id'] ?? null;
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($orderService->updateOrder($id, $data));
        break;

    case 'DELETE':
        parse_str($_SERVER['QUERY_STRING'], $params);
        $id = $params['id'] ?? null;
        echo json_encode($orderService->deleteOrder($id));
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
}