<?php
require_once __DIR__ . '/../config/database.php';
header('Content-Type: application/json; charset=utf-8');
try {
    $stmt = $pdo->query("SELECT id, name, brand, price, old_price, category, description, image_url, rating, badge, stock FROM products WHERE is_active = 1 ORDER BY sort_order ASC, id DESC");
    echo json_encode(['success' => true, 'products' => $stmt->fetchAll()], JSON_UNESCAPED_SLASHES);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Could not load products.']);
}
