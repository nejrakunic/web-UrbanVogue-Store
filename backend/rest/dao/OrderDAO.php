<?php
require_once __DIR__ . '/../config/database.php';

class OrderDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($user_id, $total_price, $status) {
        $query = "INSERT INTO Orders (User_ID, Total_price, Status) 
                  VALUES (:user_id, :total_price, :status)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':user_id' => $user_id,             ':total_price' => $total_price,             ':status' => $status
        ]);
    }

    public function readAll() {
        $query = "SELECT * FROM Orders";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $user_id, $total_price, $status) {
        $query = "UPDATE Orders SET 
                    User_ID = :user_id, Total_price = :total_price, Status = :status
                  WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(array_merge([
            ':id' => $id,
            ':user_id' => $user_id,             ':total_price' => $total_price,             ':status' => $status
        ]));
    }

    public function delete($id) {
        $query = "DELETE FROM Orders WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>