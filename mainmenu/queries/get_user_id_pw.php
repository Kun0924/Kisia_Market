<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $find_type = $_POST['find_type'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    $user_id = $_POST['user_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if ($find_type == 'find_id') {
        $sql = "SELECT * FROM users WHERE name = '$name' AND email = '$email' AND phone = '$phone'";
    } else {
        $sql = "SELECT * FROM users WHERE userId = '$user_id' AND name = '$name' AND email = '$email' AND phone = '$phone'";
    }

    $result = mysqli_query($conn, $sql);
    $user = $result->fetch_assoc();  // 한 줄 가져오기

    mysqli_close($conn);
?>
