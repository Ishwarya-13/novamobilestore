<?php
require_once __DIR__ . '/../config/database.php';
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); echo json_encode(['success'=>false]); exit; }
$data = json_decode(file_get_contents('php://input'), true) ?? [];
$email = filter_var(trim($data['email'] ?? ''), FILTER_VALIDATE_EMAIL);
if (!$email) { http_response_code(422); echo json_encode(['success'=>false,'message'=>'Enter a valid email address.']); exit; }
try {
    $stmt = $pdo->prepare('INSERT IGNORE INTO subscribers (email) VALUES (?)');
    $stmt->execute([$email]);
    echo json_encode(['success'=>true,'message'=>'You’re on the list. Watch this space!']);
} catch (PDOException $e) {
    http_response_code(500); echo json_encode(['success'=>false,'message'=>'Could not subscribe right now.']);
}
