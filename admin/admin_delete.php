<?php
require_once '../mainmenu/common/db.php';

$id = $_GET['id'] ?? 0;
$type = $_GET['type'] ?? '';
$product_id = $_GET['product_id'] ?? 0;
$sql = ''; // 미리 선언

switch ($type) {
    case 'users':
        $sql = "DELETE FROM users WHERE id = $id";
        break;
    case 'products':
        $sql = "DELETE FROM products WHERE id = $id";
        break;
    case 'orders':
        $sql = "DELETE FROM orders WHERE id = $id";
        break;
    case 'reviews':
        $sql = "DELETE FROM reviews WHERE id = $id";
        break;
    case 'notices':
        $sql = "DELETE FROM notices WHERE id = $id";
        break;
    case 'inquiry':
        $sql = "DELETE FROM inquiry WHERE id = $id";
        break;
    default:
        echo "<script>alert('유효하지 않은 삭제 유형입니다.'); location.href=document.referrer;</script>";
        exit;
}


if (!empty($sql)) {
    $result = mysqli_query($conn, $sql);
    if ($type == 'reviews') {
        // 평점 업데이트
        $sql_avg = "UPDATE products SET avg_rating = (SELECT AVG(rating) FROM reviews WHERE product_id = '$product_id') WHERE id = '$product_id'";
        $result_avg = mysqli_query($conn, $sql_avg);

        // 리뷰 개수 업데이트
        $sql_count = "UPDATE products SET review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = '$product_id') WHERE id = '$product_id'";
        $result_count = mysqli_query($conn, $sql_count);
    }
    if ($result) {
        echo "<script>alert('삭제 성공!'); location.href=document.referrer;</script>";
    } else {
        echo "<script>alert('삭제 실패: " . mysqli_error($conn) . "'); location.href=document.referrer;</script>";
    }
} else {
    echo "<script>alert('삭제할 쿼리가 없습니다.'); location.href=document.referrer;</script>";
}
?>
