<?php
require_once '../mainmenu/common/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 사용자 입력을 그대로 사용
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $image_url = $_FILES['image']['name'] ?? '';
    $desc_url = $_FILES['description']['name'] ?? '';

    // 파일 업로드 (파일명 무작위화, 확장자 필터링 없이 그대로 저장)
    $uploadDir = '../uploads/';
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image_url);
    move_uploaded_file($_FILES['description']['tmp_name'], $uploadDir . $desc_url);

    // SQL 구문에 사용자 입력 직접 삽입 (SQL Injection 취약)
    $sql = "INSERT INTO products (name, category, price, stock, image_url, description, created_at)
            VALUES ('$name', '$category', '$price', '$stock', 'uploads/$image_url', 'uploads/$desc_url', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('상품이 등록되었습니다.'); location.href='products.php';</script>";
    } else {
        echo "<script>alert('등록 실패: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>
