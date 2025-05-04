<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $get_user = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($get_user);

    mysqli_close($conn);
?>