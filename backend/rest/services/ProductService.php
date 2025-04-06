<?php
require_once __DIR__ . '/../dao/ProductDAO.php';

class ProductService {
    private $productDAO;

    public function __construct() {
        $this->productDAO = new ProductDAO();
    }

    public function getAllProducts() {
        return $this->productDAO->readAll();
    }

    public function createProduct($data) {
        return $this->productDAO->create($data['name'], $data['description'], $data['price'], $data['stock'], $data['category_id']);
    }

    public function updateProduct($id, $data) {
        return $this->productDAO->update($id, $data['name'], $data['description'], $data['price'], $data['stock'], $data['category_id']);
    }

    public function deleteProduct($id) {
        return $this->productDAO->delete($id);
    }
}
?>