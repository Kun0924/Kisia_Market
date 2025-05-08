<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $user_id = $_POST['user_id'];
    $order_id = $_POST['order_id'];
    $price = $_POST['price'];
    $payment_method = $_POST['payment_method'];

    if ($payment_method == 'point') {
        $sql = "UPDATE users SET point = point + $price WHERE id = $user_id";
        $result = mysqli_query($conn, $sql);
    }

    $sql = "UPDATE orders SET order_status = 'cancelled' WHERE id = $order_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('주문이 취소되었습니다.');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage.php';</script>";
    }
    mysqli_close($conn);
?>