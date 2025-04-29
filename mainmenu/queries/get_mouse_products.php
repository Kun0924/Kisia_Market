<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    // URL 파라미터에서 현재 페이지, 정렬 방식, 가격 범위 가져오기
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $sort = $_GET['sort'] ?? 'newest';
    $price_range = $_GET['price_range'] ?? 'all';

    $items_per_page = 6;
    $offset = ($page - 1) * $items_per_page;

    // 정렬 조건 설정
    switch ($sort) {
        case 'price-low':
            $order_by = 'price ASC';
            break;
        case 'price-high':
            $order_by = 'price DESC';
            break;
        case 'popular':
            $order_by = '';
            break;
        case 'newest':
        default:
            $order_by = 'id DESC';
    }

    // 가격 필터 조건 설정
    $price_condition = '';
    switch ($price_range) {
        case '0-50000':
            $price_condition = 'WHERE price <= 50000 and';
            break;
        case '50000-100000':
            $price_condition = 'WHERE price BETWEEN 50000 AND 100000 and';
            break;
        case '100000-150000':
            $price_condition = 'WHERE price BETWEEN 100000 AND 150000 and';
            break;
        case '150000-200000':
            $price_condition = 'WHERE price BETWEEN 150000 AND 200000 and';
            break;
        case '200000-up':
            $price_condition = 'WHERE price >= 200000 and';
            break;
        default:
            $price_condition = 'where'; // 전체 보기
    }

    // 상품 목록 쿼리
    $sql = "SELECT * FROM products $price_condition category = '마우스' ORDER BY $order_by LIMIT $offset, $items_per_page";
    $get_mouse_products = mysqli_query($conn, $sql);

    // 전체 상품 개수 쿼리 (페이징용)
    $count_sql = "SELECT COUNT(*) as total FROM products $price_condition category = '마우스'";
    $result_count = mysqli_query($conn, $count_sql);
    $total_row = mysqli_fetch_assoc($result_count);
    $total_items = (int)$total_row['total'];
    $total_pages = ceil($total_items / $items_per_page);

    mysqli_close($conn);
?>
