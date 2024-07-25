<?php

namespace App\Controllers;

use App\Models\Category;

class CategoryController
{
    private $categoryModel;

    public function __construct($pdo)
    {
        $this->categoryModel = new Category($pdo);
    }

    public function create($user_id, $name)
    {
        return $this->categoryModel->createCategory($user_id, $name);
    }

    public function getAllByUser($user_id)
    {
        return $this->categoryModel->getCategoriesByUserId($user_id);
    }

    public function update($id, $name)
    {
        return $this->categoryModel->updateCategory($id, $name);
    }

    public function delete($id)
    {
        return $this->categoryModel->deleteCategory($id);
    }
}
