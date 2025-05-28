<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];

    // $sql = "SELECT inquiry.id, inquiry.user_id, inquiry.title, inquiry.content, inquiry.is_secret, 
    //     inquiry.type, inquiry.created_at, inquiry.secret_password, users.name,
    //     inquiry.inquiry_status, inquiry.answer, inquiry.answer_at
    //     FROM inquiry LEFT JOIN users ON inquiry.user_id = users.id WHERE inquiry.id = $id";
    // $get_inquiry = mysqli_query($conn, $sql);

    // inquiry 및 user 정보 조회 (LEFT JOIN)
    $sql = "SELECT inquiry.id, inquiry.user_id, inquiry.title, inquiry.content, inquiry.is_secret, 
            inquiry.type, inquiry.created_at, inquiry.secret_password, users.name,
            inquiry.inquiry_status, inquiry.answer, inquiry.answer_at
            FROM inquiry 
            LEFT JOIN users ON inquiry.user_id = users.id 
            WHERE inquiry.id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $get_inquiry = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    // $sql_images = "SELECT * FROM inquiry_images WHERE inquiry_id = $id";
    // $get_inquiry_images = mysqli_query($conn, $sql_images);

    // inquiry 이미지 조회
    $sql_images = "SELECT * FROM inquiry_images WHERE inquiry_id = ?";
    $stmt_images = mysqli_prepare($conn, $sql_images);
    mysqli_stmt_bind_param($stmt_images, "i", $id);
    mysqli_stmt_execute($stmt_images);
    $get_inquiry_images = mysqli_stmt_get_result($stmt_images);
    mysqli_stmt_close($stmt_images);

    mysqli_close($conn);
?>
