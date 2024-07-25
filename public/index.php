<?php
session_start();
require '../vendor/autoload.php';

$pdo = require '../config/database.php';

use App\Controllers\AuthController;

$authController = new AuthController($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'login') {
        $message = $authController->login($_POST['username'], $_POST['password']);
        if ($message === 'Login successful!') {
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'>$message</div>";
        }
    } elseif ($_POST['action'] === 'register') {
        $message = $authController->register($_POST['username'], $_POST['password'], $_POST['email']);
        echo "<div class='alert alert-success'>$message</div>";
    }
}
require '../components/header.php';
?>
<?php