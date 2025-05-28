<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $orderId = $_GET['order_id'];

    // 첫 번째 쿼리 - 주문 + 주문상품 + 개수
    $sql = "
        SELECT 
            o.*, 
            oi.id as order_item_id, 
            oi.product_id,
            oi.product_name,
            oi.product_image_url,
            oi.quantity,
            oi.price,
            item_count_table.item_count
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        JOIN (
            SELECT order_id, COUNT(*) as item_count
            FROM order_items
            GROUP BY order_id
        ) item_count_table ON o.id = item_count_table.order_id
        WHERE o.id = ?
    ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $orderId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $order = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    // 두 번째 쿼리 - 주문상품 전체
    $sql_items = "SELECT * FROM order_items WHERE order_id = ?";
    $stmt_items = mysqli_prepare($conn, $sql_items);
    mysqli_stmt_bind_param($stmt_items, "i", $orderId);
    mysqli_stmt_execute($stmt_items);
    $result_items = mysqli_stmt_get_result($stmt_items);
    $order_items = mysqli_fetch_all($result_items, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt_items);
    
    $subtotal = 0;
    $shippingTotal = 0;
    $grandTotal = 0;

    foreach ($order_items as $item) {
        $subtotal += $item['price'] * $item['quantity'];
        $shippingTotal += $item['deliver_price'];
        $grandTotal += $item['price'] * $item['quantity'] + $item['deliver_price'];
    }

    mysqli_close($conn);
?>