<?php
require_once __DIR__ . '/../config/database.php';
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); echo json_encode(['success' => false, 'message' => 'Method not allowed.']); exit;
}
$data = json_decode(file_get_contents('php://input'), true) ?? [];
$name = trim($data['customer_name'] ?? '');
$email = filter_var(trim($data['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$phone = trim($data['phone'] ?? '');
$address = trim($data['address'] ?? '');
$items = $data['items'] ?? [];
if (!$name || !$email || !$phone || !$address || !is_array($items) || count($items) === 0) {
    http_response_code(422); echo json_encode(['success' => false, 'message' => 'Please complete all fields and add at least one item.']); exit;
}
try {
    $pdo->beginTransaction();
    $total = 0; $validated = [];
    $find = $pdo->prepare('SELECT id, name, price, stock FROM products WHERE id = ? AND is_active = 1 FOR UPDATE');
    foreach ($items as $item) {
        $id = (int)($item['id'] ?? 0); $qty = max(1, min(10, (int)($item['quantity'] ?? 1)));
        $find->execute([$id]); $product = $find->fetch();
        if (!$product || $product['stock'] < $qty) throw new RuntimeException('One of your selected phones is unavailable or out of stock.');
        $line = (float)$product['price'] * $qty; $total += $line;
        $validated[] = ['product' => $product, 'quantity' => $qty, 'line_total' => $line];
    }
    $order = $pdo->prepare('INSERT INTO orders (customer_name, email, phone, address, total_amount, status) VALUES (?, ?, ?, ?, ?, ?)');
    $order->execute([$name, $email, $phone, $address, $total, 'Pending']);
    $orderId = (int)$pdo->lastInsertId();
    $lineInsert = $pdo->prepare('INSERT INTO order_items (order_id, product_id, product_name, quantity, unit_price, line_total) VALUES (?, ?, ?, ?, ?, ?)');
    $stockUpdate = $pdo->prepare('UPDATE products SET stock = stock - ? WHERE id = ?');
    foreach ($validated as $row) {
        $p = $row['product'];
        $lineInsert->execute([$orderId, $p['id'], $p['name'], $row['quantity'], $p['price'], $row['line_total']]);
        $stockUpdate->execute([$row['quantity'], $p['id']]);
    }
    $pdo->commit();
    echo json_encode(['success' => true, 'order_id' => $orderId, 'message' => 'Your order has been placed. Thank you for choosing Nova!']);
} catch (RuntimeException $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(409); echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} catch (Throwable $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    http_response_code(500); echo json_encode(['success' => false, 'message' => 'Something went wrong while placing your order.']);
}
