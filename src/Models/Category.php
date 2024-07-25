<?php

namespace App\Models;

class Category
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createCategory($user_id, $name)
    {
        $stmt = $this->pdo->prepare('INSERT INTO categories (user_id, name) VALUES (?, ?)');
        return $stmt->execute([$user_id, $name]);
    }

    public function getCategoriesByUserId($user_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE user_id = ?');
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function getCategoryById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM categories WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateCategory($id, $name)
    {
        $stmt = $this->pdo->prepare('UPDATE categories SET name = ? WHERE id = ?');
        return $stmt->execute([$name, $id]);
    }

    public function deleteCategory($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM categories WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
