<?php
    session_start();

    $userId = $_SESSION['userId'] ?? '';
    $name = $_SESSION['name'] ?? '';
    $role = $_SESSION['role'] ?? '';

    // ajax 용
    // echo json_encode(['userId' => $userId, 'name' => $name, 'role' => $role]);
?>