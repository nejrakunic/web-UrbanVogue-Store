<?php
header("Content-Type: application/json");

// Pokreni samo ako dolazi HTTP zahtev
if (!isset($_SERVER['REQUEST_METHOD'])) {
    echo json_encode(["message" => "This file must be accessed through an HTTP request (via browser or Postman)."]);
    exit;
}

// Autoload (ako koristiš composer autoload)
// require __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/routes/users.php';
require_once __DIR__ . '/routes/products.php';
require_once __DIR__ . '/routes/categories.php';
require_once __DIR__ . '/routes/orders.php';
require_once __DIR__ . '/routes/orderitem.php'; // proveri ime fajla
require_once __DIR__ . '/routes/cart.php';

