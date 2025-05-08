<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];

    $sql = "SELECT inquiry.id, inquiry.user_id, inquiry.title, inquiry.content, inquiry.is_secret, 
        inquiry.type, inquiry.created_at, inquiry.secret_password, users.name,
        inquiry.inquiry_status, inquiry.answer, inquiry.answer_at
        FROM inquiry LEFT JOIN users ON inquiry.user_id = users.id WHERE inquiry.id = $id";
    $get_inquiry = mysqli_query($conn, $sql);

    $sql_images = "SELECT * FROM inquiry_images WHERE inquiry_id = $id";
    $get_inquiry_images = mysqli_query($conn, $sql_images);

    mysqli_close($conn);
?>
