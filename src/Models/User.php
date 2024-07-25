<?php

namespace App\Models;

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser($username, $password, $email)
    {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare('INSERT INTO users (username, password_hash, email) VALUES (?, ?, ?)');
        return $stmt->execute([$username, $password_hash, $email]);
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        return $stmt->fetch();
    }


}
?>