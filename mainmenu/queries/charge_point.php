<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_POST['id'];
    $charge_amount = $_POST['charge_amount'] ?? 0;
    $custom_amount = $_POST['custom_amount'] ?? 0;

    if ($charge_amount == 'custom') {
        $charge_amount = $custom_amount;
    }   

    $sql = "UPDATE users SET point = point + $charge_amount WHERE id = $userId";
    $result =  mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('포인트 충전에 성공했습니다.');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage_profile.php';</script>";
    } else {
        echo "<script>alert('포인트 충전에 실패했습니다.');</script>";
    }

    mysqli_close($conn);
?>