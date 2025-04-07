<?php
require_once __DIR__ . '/../config/database.php';

class UserDAO {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($name, $email, $password, $role) {
        $query = "INSERT INTO Users (Name, Email, Password, Role) 
                  VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':name' => $name,             ':email' => $email,             ':password' => $password,             ':role' => $role
        ]);
    }

    public function readAll() {
        $query = "SELECT * FROM Users";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $password, $role) {
        $query = "UPDATE Users SET 
                    Name = :name, Email = :email, Password = :password, Role = :role
                  WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(array_merge([
            ':id' => $id,
            ':name' => $name,             ':email' => $email,             ':password' => $password,             ':role' => $role
        ]));
    }

    public function delete($id) {
        $query = "DELETE FROM Users WHERE ID = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>