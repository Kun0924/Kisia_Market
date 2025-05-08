<?php
require_once '../mainmenu/common/db.php';

$id = $_GET['id'] ?? 0;
$type = $_GET['type'] ?? '';
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
    if ($result) {
        echo "<script>alert('삭제 성공!'); location.href=document.referrer;</script>";
    } else {
        echo "<script>alert('삭제 실패: " . mysqli_error($conn) . "'); location.href=document.referrer;</script>";
    }
} else {
    echo "<script>alert('삭제할 쿼리가 없습니다.'); location.href=document.referrer;</script>";
}
?>
