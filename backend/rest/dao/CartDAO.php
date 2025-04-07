<?php
require_once __DIR__ . '/../config/database.php';


class CartDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($user_id, $product_id, $quantity) {
        $query = "INSERT INTO Cart (User_ID, Product_ID, Quantity) 
                  VALUES (:user_id, :product_id, :quantity)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':user_id' => $user_id,             ':product_id' => $product_id,             ':quantity' => $quantity
        ]);
    }

    public function readAll() {
        $query = "SELECT * FROM Cart";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $user_id, $product_id, $quantity) {
        $query = "UPDATE Cart SET 
                    User_ID = :user_id, Product_ID = :product_id, Quantity = :quantity
                  WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(array_merge([
            ':id' => $id,
            ':user_id' => $user_id,             ':product_id' => $product_id,             ':quantity' => $quantity
        ]));
    }

    public function delete($id) {
        $query = "DELETE FROM Cart WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>