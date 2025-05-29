<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = isset($_SESSION['id']);
    if(!$userId){
        echo "<script>
            alert('접근 권한이 없습니다.');
            window.location.href = '../index.php';
        </script>";
        exit;
    }

    // 유저 정보 조회
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // 주문 수 조회
    $sql = "SELECT COUNT(*) as order_count FROM orders WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $order_count = mysqli_fetch_assoc($result)['order_count'];
    mysqli_stmt_close($stmt);

    // 배송 준비중 수 조회
    $sql = "SELECT COUNT(*) as shipping_count FROM orders WHERE user_id = ? AND order_status = 'paid'";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $shipping_count = mysqli_fetch_assoc($result)['shipping_count'];
    mysqli_stmt_close($stmt);
?>