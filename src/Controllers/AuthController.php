<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function register($username, $password, $email)
    {
        if ($this->userModel->getUserByUsername($username)) {
            return 'Username already exists!';
        }

        if ($this->userModel->createUser($username, $password, $email)) {
            return 'User registered successfully!';
        } else {
            return 'Failed to register user.';
        }
    }

    public function login($username, $password)
    {
        $user = $this->userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            return 'Login successful!';
        } else {
            return 'Invalid username or password.';
        }
    }

    public function logout()
    {
        session_destroy();
        return 'Logged out successfully.';
    }
}
