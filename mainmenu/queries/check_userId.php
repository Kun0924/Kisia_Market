<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $username = $_POST['username'];

    $sql = "SELECT * FROM users WHERE userId = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }

    mysqli_close($conn);
?>