<?php
require_once '/var/www/html/mainmenu/common/db.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$search_query_raw = isset($_GET['search_query']) ? $_GET['search_query'] : '';

$items_per_page = 6;
$offset = ($page - 1) * $items_per_page;

// 기본값
$sql = "";
$count_sql = "";
$params = [];
$types = "";

if ($search_query_raw) {
    $search_query = "%" . $search_query_raw . "%";

    // 데이터 목록 쿼리
    $sql = "SELECT * FROM notices WHERE title LIKE ? ORDER BY id DESC LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    $types = "sii";
    $params = [$search_query, $offset, $items_per_page];
} else {
    $sql = "SELECT * FROM notices ORDER BY id DESC LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    $types = "ii";
    $params = [$offset, $items_per_page];
}

// 파라미터 바인딩 및 실행
mysqli_stmt_bind_param($stmt, $types, ...$params);
mysqli_stmt_execute($stmt);
$get_notice = mysqli_stmt_get_result($stmt);

// 전체 개수 쿼리 (페이징용)
if ($search_query_raw) {
    $count_sql = "SELECT COUNT(*) as total FROM notices WHERE title LIKE ?";
    $count_stmt = mysqli_prepare($conn, $count_sql);
    mysqli_stmt_bind_param($count_stmt, "s", $search_query);
} else {
    $count_sql = "SELECT COUNT(*) as total FROM notices";
    $count_stmt = mysqli_prepare($conn, $count_sql);
}

mysqli_stmt_execute($count_stmt);
$result_count = mysqli_stmt_get_result($count_stmt);
$total_row = mysqli_fetch_assoc($result_count);
$total_items = (int)$total_row['total'];
$total_pages = ceil($total_items / $items_per_page);

// 정리
mysqli_stmt_close($stmt);
mysqli_stmt_close($count_stmt);
mysqli_close($conn);
?>
