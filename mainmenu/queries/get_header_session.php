<?php
    session_start();

    $id = $_SESSION['id'] ?? '';
    $userId = $_SESSION['userId'] ?? '';
    $name = $_SESSION['name'] ?? '';
    $email = $_SESSION['email'] ?? '';
    $role = $_SESSION['role'] ?? '';
    
    // ajax 용
    // echo json_encode(['userId' => $userId, 'name' => $name, 'role' => $role]);
?>