<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];

    $sql = "DELETE FROM inquiry WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('문의글 삭제에 성공했습니다.');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage_inquiry.php';</script>";
    } else {
        echo "<script>alert('문의글 삭제에 실패했습니다.');</script>";
    }

    mysqli_close($conn);
?>