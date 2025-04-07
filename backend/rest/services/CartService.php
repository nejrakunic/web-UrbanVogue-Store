<?php
require_once __DIR__ . '/../dao/CartDAO.php';

class CartService {
    private $cartDAO;

    public function __construct() {
        $this->cartDAO = new CartDAO();
    }

    public function getAllCartItems() {
        return $this->cartDAO->readAll();
    }

    public function createCartItem($data) {
        return $this->cartDAO->create(
            $data['user_id'],
            $data['product_id'],
            $data['quantity']
        );
    }

    public function updateCartItem($id, $data) {
        return $this->cartDAO->update(
            $id,
            $data['user_id'],
            $data['product_id'],
            $data['quantity']
        );
    }

    public function deleteCartItem($id) {
        return $this->cartDAO->delete($id);
    }
}
?>
