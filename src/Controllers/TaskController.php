<?php

namespace App\Controllers;

use App\Models\Task;

class TaskController
{
    private $taskModel;

    public function __construct($pdo)
    {
        $this->taskModel = new Task($pdo);
    }

    public function create($user_id, $category_id, $title, $description)
    {
        return $this->taskModel->createTask($user_id, $category_id, $title, $description);
    }

    public function getAllByUser($user_id)
    {
        return $this->taskModel->getTasksByUserId($user_id);
    }

    public function update($id, $title, $description)
    {
        return $this->taskModel->updateTask($id, $title, $description);
    }

    public function delete($id)
    {
        return $this->taskModel->deleteTask($id);
    }
}
