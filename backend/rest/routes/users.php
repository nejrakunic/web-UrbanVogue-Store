<?php
require_once __DIR__ . '/../services/UserService.php';

$userService = new UserService();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        echo json_encode($userService->getAllUsers());
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($userService->createUser($data));
        break;

    case 'PUT':
        parse_str($_SERVER['QUERY_STRING'], $params);
        $id = $params['id'] ?? null;
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($userService->updateUser($id, $data));
        break;

    case 'DELETE':
        parse_str($_SERVER['QUERY_STRING'], $params);
        $id = $params['id'] ?? null;
        echo json_encode($userService->deleteUser($id));
        break;

    default:
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
}