<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_SESSION['id'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 3;
    $offset = ($page - 1) * $items_per_page;

    // 주문 목록 조회
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
        WHERE o.user_id = ?
        ORDER BY o.id DESC
        LIMIT ?, ?
    ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $userId, $offset, $items_per_page);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
    
    // 전체 개수 조회
    $count_sql = "SELECT COUNT(*) as total FROM orders WHERE user_id = ?";
    $stmt_count = mysqli_prepare($conn, $count_sql);
    mysqli_stmt_bind_param($stmt_count, "i", $userId);
    mysqli_stmt_execute($stmt_count);
    $result_count = mysqli_stmt_get_result($stmt_count);
    $total_row = mysqli_fetch_assoc($result_count);
    $total_items = (int)$total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);
    mysqli_stmt_close($stmt_count);

    mysqli_close($conn);
?>