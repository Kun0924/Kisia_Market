<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

    $items_per_page = 6;
    $offset = ($page - 1) * $items_per_page;

    $sql = "SELECT * FROM notices ORDER BY id DESC LIMIT $offset, $items_per_page";
    $get_notice = mysqli_query($conn, $sql);

    // 전체 공지 개수 쿼리 (페이징용)
    $count_sql = "SELECT COUNT(*) as total FROM notices";
    $result_count = mysqli_query($conn, $count_sql);
    $total_row = mysqli_fetch_assoc($result_count);
    $total_items = (int)$total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);

    mysqli_close($conn);
?>
