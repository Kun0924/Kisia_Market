<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_SESSION['id'];
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $items_per_page = 3;
    $offset = ($page - 1) * $items_per_page;

    $sql = "SELECT reviews.id, reviews.content, reviews.rating, reviews.created_at, products.name, products.id as product_id, products.image_url FROM reviews JOIN products ON reviews.product_id = products.id WHERE user_id = '$userId' LIMIT $offset, $items_per_page";
    $get_review = mysqli_query($conn, $sql);

    $review = mysqli_fetch_all($get_review, MYSQLI_ASSOC);

    $count_sql = "SELECT COUNT(*) as total FROM reviews WHERE user_id = '$userId'";
    $result_count = mysqli_query($conn, $count_sql);
    $total_row = mysqli_fetch_assoc($result_count);
    $total_items = (int)$total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);


    mysqli_close($conn);
?>