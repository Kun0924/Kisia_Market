<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $orderId = $_GET['order_id'];

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
        WHERE o.id = '$orderId'
    ";
    $result = mysqli_query($conn, $sql);
    $order = mysqli_fetch_assoc($result);

    $sql = "SELECT * FROM order_items WHERE order_id = '$orderId'";
    $result = mysqli_query($conn, $sql);
    $order_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
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