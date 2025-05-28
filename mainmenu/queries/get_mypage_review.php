<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_SESSION['id'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 3;
    $offset = ($page - 1) * $items_per_page;

    // 리뷰 조회 쿼리 (prepare 적용)
    $sql = "
        SELECT 
            reviews.id, reviews.content, reviews.rating, reviews.created_at, 
            products.name, products.id as product_id, products.image_url 
        FROM reviews 
        JOIN products ON reviews.product_id = products.id 
        WHERE reviews.user_id = ?
        LIMIT ?, ?
    ";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $userId, $offset, $items_per_page);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $review = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);

    // 총 리뷰 수 조회 (prepare 적용)
    $count_sql = "SELECT COUNT(*) as total FROM reviews WHERE user_id = ?";
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