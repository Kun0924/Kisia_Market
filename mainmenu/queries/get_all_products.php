<?php
require_once '/var/www/html/mainmenu/common/db.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$sort = $_GET['sort'] ?? 'newest';
$price_range = $_GET['price_range'] ?? 'all';
$category_filter = $_GET['category'] ?? 'all';
$search_query_input = $_GET['search_query'] ?? '';

$items_per_page = 6;
$offset = ($page - 1) * $items_per_page;

$params = [];
$types = '';
$where_clauses = [];

// 가격 필터 조건
switch ($price_range) {
    case '0-50000':
        $where_clauses[] = 'price <= ?';
        $params[] = 50000;
        $types .= 'i';
        break;
    case '50000-100000':
        $where_clauses[] = 'price BETWEEN ? AND ?';
        $params[] = 50000;
        $params[] = 100000;
        $types .= 'ii';
        break;
    case '100000-150000':
        $where_clauses[] = 'price BETWEEN ? AND ?';
        $params[] = 100000;
        $params[] = 150000;
        $types .= 'ii';
        break;
    case '150000-200000':
        $where_clauses[] = 'price BETWEEN ? AND ?';
        $params[] = 150000;
        $params[] = 200000;
        $types .= 'ii';
        break;
    case '200000-up':
        $where_clauses[] = 'price >= ?';
        $params[] = 200000;
        $types .= 'i';
        break;
    default:
        $where_clauses[] = '1=1';
}

// 카테고리
if ($category_filter !== 'all') {
    $where_clauses[] = 'category = ?';
    $params[] = $category_filter;
    $types .= 's';
}

// 검색어
if (!empty($search_query_input)) {
    $where_clauses[] = 'name LIKE ?';
    $params[] = '%' . $search_query_input . '%';
    $types .= 's';
}

$where_sql = 'WHERE ' . implode(' AND ', $where_clauses);

// 정렬 조건
switch ($sort) {
    case 'price-low':
        $order_by = 'price ASC';
        break;
    case 'price-high':
        $order_by = 'price DESC';
        break;
    case 'popular':
        $order_by = 'avg_rating DESC';
        break;
    case 'newest':
    default:
        $order_by = 'id DESC';
}

// 상품 목록 쿼리
$sql = "SELECT * FROM products $where_sql ORDER BY $order_by LIMIT ?, ?";
$params[] = $offset;
$params[] = $items_per_page;
$types .= 'ii';

$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("쿼리 준비 실패: " . $conn->error);
}
$stmt->bind_param($types, ...$params);
$stmt->execute();
$get_all_products = $stmt->get_result();

// 전체 상품 개수 쿼리
$count_sql = "SELECT COUNT(*) as total FROM products $where_sql";
$count_stmt = $conn->prepare($count_sql);
$count_params = array_slice($params, 0, -2); // LIMIT 제거
$count_types = substr($types, 0, -2);
if (!empty($count_params)) {
    $count_stmt->bind_param($count_types, ...$count_params);
}
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total_row = $count_result->fetch_assoc();
$total_items = (int)$total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

mysqli_close($conn);
?>
