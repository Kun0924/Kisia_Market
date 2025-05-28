<?php
require_once '/var/www/html/mainmenu/common/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// 상품 정보 조회
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$get_product_detail = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

// 리뷰 정보 조회
$sql = "
    SELECT 
        reviews.id, reviews.user_id, reviews.product_id, reviews.content, reviews.rating, 
        reviews.image_url, reviews.created_at, users.name 
    FROM reviews 
    LEFT JOIN users ON reviews.user_id = users.id 
    WHERE reviews.product_id = ?
    ORDER BY reviews.created_at DESC
";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$get_reviews = mysqli_stmt_get_result($stmt);
mysqli_stmt_close($stmt);

mysqli_close($conn);
?>
