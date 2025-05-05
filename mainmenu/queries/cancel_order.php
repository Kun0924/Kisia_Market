<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $order_id = $_GET['order_id'];

    $sql = "UPDATE orders SET order_status = 'cancelled' WHERE id = $order_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('주문이 취소되었습니다.');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage.php';</script>";
    }
    mysqli_close($conn);
?>