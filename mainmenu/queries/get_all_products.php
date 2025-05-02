<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    // URL 파라미터에서 현재 페이지, 정렬 방식, 가격 범위 가져오기
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $sort = $_GET['sort'] ?? 'newest';
    $price_range = $_GET['price_range'] ?? 'all';
    $category = $_GET['category'] ?? 'all';
    $search_query = $_GET['search_query'] ?? '';
    if ($search_query) {
        $search_query = 'AND name LIKE "%' . $search_query . '%"';
    }


    $items_per_page = 6;
    $offset = ($page - 1) * $items_per_page;

    if ($category == 'all') {
        $category = '';
    } else {
        $category = 'AND category = "' . $category . '"';
    }

    // 정렬 조건 설정
    switch ($sort) {
        case 'price-low':
            $order_by = 'price ASC';
            break;
        case 'price-high':
            $order_by = 'price DESC';
            break;
        case 'popular':
            $order_by = 'rating DESC';
            break;
        case 'newest':
        default:
            $order_by = 'id DESC';
    }

    // 가격 필터 조건 설정
    $price_condition = '';
    switch ($price_range) {
        case '0-50000':
            $price_condition = 'WHERE price <= 50000';
            break;
        case '50000-100000':
            $price_condition = 'WHERE price BETWEEN 50000 AND 100000';
            break;
        case '100000-150000':
            $price_condition = 'WHERE price BETWEEN 100000 AND 150000';
            break;
        case '150000-200000':
            $price_condition = 'WHERE price BETWEEN 150000 AND 200000';
            break;
        case '200000-up':
            $price_condition = 'WHERE price >= 200000';
            break;
        default:
            $price_condition = 'WHERE 1=1'; // 전체 보기
    }

    // 상품 목록 쿼리
    $sql = "SELECT * FROM products $price_condition $category $search_query ORDER BY $order_by LIMIT $offset, $items_per_page";
    error_log("sql!!!!!!!!!!: " . $sql);
    $get_all_products = mysqli_query($conn, $sql);

    // 전체 상품 개수 쿼리 (페이징용)
    $count_sql = "SELECT COUNT(*) as total FROM products $price_condition $category $search_query";
    $result_count = mysqli_query($conn, $count_sql);
    $total_row = mysqli_fetch_assoc($result_count);
    $total_items = (int)$total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);

    mysqli_close($conn);
?>
