<?php
session_start();
require '../vendor/autoload.php';
require '../components/util.php';
$pdo = require '../config/database.php';

use App\Controllers\CategoryController;
use App\Controllers\TaskController;

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$categoryController = new CategoryController($pdo);
$taskController = new TaskController($pdo);

$username = getUsernameByUserId($pdo, $_SESSION['user_id']);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'create_category') {
        $message = $categoryController->create($_SESSION['user_id'], $_POST['name']) ? 'Category created successfully.' : 'Failed to create category.';
    } elseif ($_POST['action'] === 'update_category') {
        $message = $categoryController->update($_POST['id'], $_POST['name']) ? 'Category updated successfully.' : 'Failed to update category.';
    } elseif ($_POST['action'] === 'delete_category') {
        $message = $categoryController->delete($_POST['id']) ? 'Category deleted successfully.' : 'Failed to delete category.';
    } elseif ($_POST['action'] === 'create_task') {
        $message = $taskController->create($_SESSION['user_id'], $_POST['category_id'], $_POST['title'], $_POST['description']) ? 'Task created successfully.' : 'Failed to create task.';
    } elseif ($_POST['action'] === 'update_task') {
        $message = $taskController->update($_POST['id'], $_POST['title'], $_POST['description']) ? 'Task updated successfully.' : 'Failed to update task.';
    } elseif ($_POST['action'] === 'delete_task') {
        $message = $taskController->delete($_POST['id']) ? 'Task deleted successfully.' : 'Failed to delete task.';
    }
}

$categories = $categoryController->getAllByUser($_SESSION['user_id']);
$tasks = $taskController->getAllByUser($_SESSION['user_id']);

$selectedCategory = isset($_GET['category_id']) ? $_GET['category_id'] : null;
if ($selectedCategory) {
    $tasks = array_filter($tasks, function($task) use ($selectedCategory) {
        return $task['category_id'] == $selectedCategory;
    });
}

require "../components/dashboardHeader.php";
