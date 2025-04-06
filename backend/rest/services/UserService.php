<?php
require_once __DIR__ . '/../dao/UserDAO.php';

class UserService {
    private $userDAO;

    public function __construct() {
        $this->userDAO = new UserDAO();
    }

    public function getAllUsers() {
        return $this->userDAO->readAll();
    }

    public function createUser($data) {
        return $this->userDAO->create($data);
    }

    public function updateUser($id, $data) {
        return $this->userDAO->update($id, $data);
    }

    public function deleteUser($id) {
        return $this->userDAO->delete($id);
    }
}
