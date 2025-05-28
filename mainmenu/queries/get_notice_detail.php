<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM notices WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $get_notice = mysqli_stmt_get_result($stmt);

    mysqli_stmt_close($stmt);

    mysqli_close($conn);
?>
