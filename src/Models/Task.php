<?php

namespace App\Models;

class Task
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTask($user_id, $category_id, $title, $description)
    {
        $stmt = $this->pdo->prepare('INSERT INTO tasks (user_id, category_id, title, description) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$user_id, $category_id, $title, $description]);
    }

    public function getTasksByUserId($user_id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE user_id = ?');
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function getTaskById($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM tasks WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateTask($id, $title, $description)
    {
        $stmt = $this->pdo->prepare('UPDATE tasks SET title = ?, description = ? WHERE id = ?');
        return $stmt->execute([$title, $description, $id]);
    }

    public function deleteTask($id)
    {
        $stmt = $this->pdo->prepare('DELETE FROM tasks WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
