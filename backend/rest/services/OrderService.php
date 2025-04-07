<?php
require_once __DIR__ . '/../dao/OrderDAO.php';

class OrderService {
    private $orderDAO;

    public function __construct() {
        $this->orderDAO = new OrderDAO();
    }

    public function getAllOrders() {
        return $this->orderDAO->readAll();
    }

    public function createOrder($data) {
        return $this->orderDAO->create($data['user_id'], $data['total_price'], $data['status']);
    }

    public function updateOrder($id, $data) {
        return $this->orderDAO->update($id, $data['user_id'], $data['total_price'], $data['status']);
    }

    public function deleteOrder($id) {
        return $this->orderDAO->delete($id);
    }
}
?>