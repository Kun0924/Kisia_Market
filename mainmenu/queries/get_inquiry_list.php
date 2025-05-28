<?php
require_once '/var/www/html/mainmenu/common/db.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

$items_per_page = 5;
$offset = ($page - 1) * $items_per_page;

$search_clause = '';
$params = [];
$param_types = '';

if (!empty($search_query)) {
    $search_clause = 'WHERE i.title LIKE ?';
    $params[] = '%' . $search_query . '%';
    $param_types .= 's';
}

// 문의 목록 쿼리
$sql = "
    SELECT 
        i.id, i.title, i.type, i.is_secret, i.created_at, i.inquiry_status,
        u.userId, u.name
    FROM inquiry i
    LEFT JOIN users u ON i.user_id = u.id
    $search_clause
    ORDER BY i.id DESC
    LIMIT ?, ?
";

$params[] = $offset;
$params[] = $items_per_page;
$param_types .= 'ii';

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, $param_types, ...$params);
mysqli_stmt_execute($stmt);
$get_inquiry = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

// 총 개수 조회 쿼리
$count_sql = "SELECT COUNT(*) as total FROM inquiry i $search_clause";
$stmt_count = mysqli_prepare($conn, $count_sql);
if (!empty($search_query)) {
    mysqli_stmt_bind_param($stmt_count, 's', $params[0]); // 검색어만
}
mysqli_stmt_execute($stmt_count);
$result_count = mysqli_stmt_get_result($stmt_count);
$total_row = mysqli_fetch_assoc($result_count);
$total_items = (int)$total_row['total'];
$total_pages = ceil($total_items / $items_per_page);
mysqli_stmt_close($stmt_count);

mysqli_close($conn);
?>
