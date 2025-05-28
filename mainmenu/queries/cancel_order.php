<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $user_id = $_POST['user_id'];
    $order_id = $_POST['order_id'];
    $price = $_POST['price'];
    $payment_method = $_POST['payment_method'];

    // if ($payment_method == 'point') {
    //     $sql = "UPDATE users SET point = point + $price WHERE id = $user_id";
    //     $result = mysqli_query($conn, $sql);
    // }

    if ($payment_method == 'point') {
        $stmt = $conn->prepare("UPDATE users SET point = point + ? WHERE id = ?");
        $stmt->bind_param("di", $price, $user_id); // d: double, i: integer
        $stmt->execute();
        $stmt->close();
    }

    // $sql = "UPDATE orders SET order_status = 'cancelled' WHERE id = $order_id";
    // $result = mysqli_query($conn, $sql);

    // if ($result) {
    //     echo "<script>alert('주문이 취소되었습니다.');</script>";
    //     echo "<script>window.location.href = '/mainmenu/mypage.php';</script>";
    // }

    $stmt = $conn->prepare("UPDATE orders SET order_status = 'cancelled' WHERE id = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<script>alert('주문이 취소되었습니다.');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage.php?tab=mypage_order.php';</script>";
    } else {
        echo "<script>alert('주문 취소에 실패했습니다.');</script>";
    }
    $stmt->close();

    mysqli_close($conn);
?>