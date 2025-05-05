<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_SESSION['id'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 3;
    $offset = ($page - 1) * $items_per_page;

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
        JOIN (
            SELECT * FROM order_items oi1 
            WHERE (SELECT COUNT(*) FROM order_items oi2 WHERE oi2.order_id = oi1.order_id AND oi2.id < oi1.id) = 0
        ) oi ON o.id = oi.order_id
        JOIN (
            SELECT order_id, COUNT(*) as item_count
            FROM order_items
            GROUP BY order_id
        ) item_count_table ON o.id = item_count_table.order_id
        WHERE o.user_id = '$userId'
        ORDER BY o.id DESC
        LIMIT $offset, $items_per_page
    ";
    $result = mysqli_query($conn, $sql);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    $count_sql = "SELECT COUNT(*) as total FROM orders WHERE user_id = '$userId'";
    $result_count = mysqli_query($conn, $count_sql);
    $total_row = mysqli_fetch_assoc($result_count);
    $total_items = (int)$total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);

    mysqli_close($conn);
?>