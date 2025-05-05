<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_SESSION['id'];

    $sql = "SELECT * FROM users WHERE id = '$userId'";
    $get_user = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($get_user);

    $sql = "SELECT COUNT(*) as order_count FROM orders WHERE user_id = '$userId'";
    $get_order_count = mysqli_query($conn, $sql);
    $order_count = mysqli_fetch_assoc($get_order_count)['order_count'];

    $sql = "SELECT COUNT(*) as shipping_count FROM orders WHERE user_id = '$userId' AND order_status = 'paid'";
    $get_shipping_count = mysqli_query($conn, $sql);
    $shipping_count = mysqli_fetch_assoc($get_shipping_count)['shipping_count'];
?>