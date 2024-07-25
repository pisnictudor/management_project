<?php
require '../config/database.php';

function getUsernameByUserId($pdo, $userId) {
    $stmt = $pdo->prepare("SELECT username FROM users WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user ? $user['username'] : null;
}
?>