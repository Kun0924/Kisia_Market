<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    session_start();

    $user_id = $_POST['user_id'];
    $sql = "DELETE FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        session_destroy();
        echo "<script>alert('회원 탈퇴가 완료되었습니다.');</script>";
        echo "<script>window.location.href = '/';</script>";
    } else {
        echo "<script>alert('회원 탈퇴에 실패했습니다. 다시 시도해주세요.');</script>";
        echo "<script>window.location.href = '/';</script>";
    }
    mysqli_close($conn);
?>