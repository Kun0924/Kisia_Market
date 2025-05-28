<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_SESSION['id'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 3;
    $offset = ($page - 1) * $items_per_page;

    // $sql = "SELECT * FROM inquiry WHERE user_id = '$userId' LIMIT $offset, $items_per_page";
    // $get_inquiry = mysqli_query($conn, $sql);

    // $inquiry = mysqli_fetch_all($get_inquiry, MYSQLI_ASSOC);

    // 목록 조회 - prepare statement
    $sql = "SELECT * FROM inquiry WHERE user_id = ? LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $userId, $offset, $items_per_page);
    mysqli_stmt_execute($stmt);
    $get_inquiry = mysqli_stmt_get_result($stmt);
    $inquiry = mysqli_fetch_all($get_inquiry, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    // 총 개수 조회 - prepare statement
    $count_sql = "SELECT COUNT(*) as total FROM inquiry WHERE user_id = ?";
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