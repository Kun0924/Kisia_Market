<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_SESSION['id'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 3;
    $offset = ($page - 1) * $items_per_page;

    $sql = "SELECT * FROM inquiry WHERE user_id = '$userId' LIMIT $offset, $items_per_page";
    $get_inquiry = mysqli_query($conn, $sql);

    $inquiry = mysqli_fetch_all($get_inquiry, MYSQLI_ASSOC);

    $count_sql = "SELECT COUNT(*) as total FROM inquiry WHERE user_id = '$userId'";
    $result_count = mysqli_query($conn, $count_sql);
    $total_row = mysqli_fetch_assoc($result_count);
    $total_items = (int)$total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);

    mysqli_close($conn);
?>