<?php
require_once '/var/www/html/mainmenu/common/db.php';

$review_id = $_POST['review_id'] ?? '';
$productId = $_POST['product_id'] ?? '';
$rating = $_POST['rating'] ?? '';
$content = $_POST['content'] ?? '';
$delete_image = $_POST['delete_image'] ?? '';
$previous_image = $_POST['previous_image'] ?? '';

// 이미지 처리
$imageUrl = $previous_image;
if ($delete_image) {
    $imageUrl = '';
}

if (strlen($content) > 1000) {
    echo "<script>alert('내용은 1000자 이하로 입력해주세요.'); history.back();</script>";
    exit;
}

// 새 이미지 업로드
if (!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['file']['tmp_name'];
    $fileName = basename($_FILES['file']['name']);
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

    if (!in_array($ext, $allowed_ext)) {
        echo json_encode(['success' => false, 'message' => '허용되지 않은 파일 형식입니다.']);
        exit;
    }

    $uniqueFileName = uniqid() . '_' . $fileName;
    $imageUrl = 'review_images/' . $uniqueFileName;
    $uploadPath = '/var/www/html/' . $imageUrl;

    if (!move_uploaded_file($tmpName, $uploadPath)) {
        echo json_encode(['success' => false, 'message' => '파일 업로드에 실패했습니다.']);
        exit;
    }
} else if (!empty($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
    echo json_encode(['success' => false, 'message' => '파일 업로드 중 오류 발생']);
    exit;
}

// 리뷰 업데이트 (Prepared Statement)
$stmt = mysqli_prepare($conn, "UPDATE reviews SET rating = ?, content = ?, image_url = ? WHERE id = ?");
mysqli_stmt_bind_param($stmt, "issi", $rating, $content, $imageUrl, $review_id);
$result = mysqli_stmt_execute($stmt);

if ($result) {
    // 평균 별점 및 리뷰 수 업데이트
    $stmt_avg = mysqli_prepare($conn, "UPDATE products SET avg_rating = (SELECT ROUND(AVG(rating), 1) FROM reviews WHERE product_id = ?) WHERE id = ?");
    mysqli_stmt_bind_param($stmt_avg, "ii", $productId, $productId);
    mysqli_stmt_execute($stmt_avg);
    mysqli_stmt_close($stmt_avg);

    $stmt_count = mysqli_prepare($conn, "UPDATE products SET review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = ?) WHERE id = ?");
    mysqli_stmt_bind_param($stmt_count, "ii", $productId, $productId);
    mysqli_stmt_execute($stmt_count);
    mysqli_stmt_close($stmt_count);

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => '리뷰 업데이트 실패']);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
