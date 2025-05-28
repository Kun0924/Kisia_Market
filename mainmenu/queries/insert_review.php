<?php
require_once '/var/www/html/mainmenu/common/db.php';

$userId = $_POST['user_id'] ?? '';
$productId = $_POST['product_id'] ?? '';
$content = $_POST['content'] ?? '';
$rating = $_POST['rating'] ?? '';
$imageName = $_FILES['file']['name'] ?? '';

$imageUrl = '';

// 첨부파일 업로드
if (!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($fileExt, $allowedExt)) {
        echo "<script>
            alert('허용되지 않은 파일 형식입니다. (jpg, jpeg, png, gif만 허용)');
            history.back();
        </script>";
        exit;
    }

    $uniqueFileName = uniqid() . '_' . $fileName;
    $imageUrl = 'review_images/' . $uniqueFileName;

    if (!move_uploaded_file($tmpName, '/var/www/html/' . $imageUrl)) {
        echo "파일 저장 실패";
        $result = false;
    }
} else if (!empty($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
    echo "파일 업로드 오류: " . $_FILES['file']['error'];
    $result = false;
}

// 리뷰 등록
$stmt = mysqli_prepare($conn, "INSERT INTO reviews (user_id, product_id, content, rating, image_url) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssis", $userId, $productId, $content, $rating, $imageUrl);
$result = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// 평점 업데이트
$stmt = mysqli_prepare($conn, "UPDATE products SET avg_rating = (SELECT AVG(rating) FROM reviews WHERE product_id = ?) WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ss", $productId, $productId);
$result = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// 리뷰 개수 업데이트
$stmt = mysqli_prepare($conn, "UPDATE products SET review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = ?) WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ss", $productId, $productId);
$result = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($result) {
    echo "<script>
        alert('리뷰가 완료되었습니다.');
        window.location.href = '/mainmenu/product_explain.php?id=$productId';
    </script>";
} else {
    echo "<script>
        alert('리뷰에 실패했습니다.');
        history.back();
    </script>";
}

mysqli_close($conn);
?>
