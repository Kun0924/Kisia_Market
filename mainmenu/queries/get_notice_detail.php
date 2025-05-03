<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];

    $sql = "SELECT * FROM notices WHERE id = $id";
    $get_notice = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
