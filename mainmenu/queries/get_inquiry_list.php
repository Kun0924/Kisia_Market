<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $items_per_page = 5;
    $offset = ($page - 1) * $items_per_page;

    // 상품 목록 쿼리
    $sql = "
        SELECT 
            i.id, i.title, i.type, i.is_secret, i.created_at, i.inquiry_status,
            u.userId, u.name
        FROM inquiry i
        JOIN users u ON i.user_id = u.id
        ORDER BY i.id DESC
        LIMIT $offset, $items_per_page
    ";
    $get_inquiry = mysqli_query($conn, $sql);

    $count_sql = "SELECT COUNT(*) as total FROM inquiry";
    $result_count = mysqli_query($conn, $count_sql);
    $total_row = mysqli_fetch_assoc($result_count);
    $total_items = (int)$total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);

    mysqli_close($conn);
?>
