<?php
require_once '/var/www/html/mainmenu/common/db.php';

$inquiry_id = $_POST['inquiry_id'] ?? 'none';
$type = $_POST['category'] ?? 'none';
$title = $_POST['title'] ?? 'none';
$content = $_POST['content'] ?? 'none';
$isSecret = isset($_POST['isSecret']) ? 1 : 0;
$secretPassword = $_POST['secretPassword'] ?? 'none';
$userId = $_POST['user_id'] ?? 'none';
$delete_files = $_POST['delete_files'] ?? '';

// 카테고리 번역
$category_map = [
    'order' => '주문/결제',
    'delivery' => '배송',
    'return' => '반품/교환',
    'product' => '상품',
    'etc' => '기타',
];
$type = $category_map[$type] ?? '기타';

// UPDATE 문의사항
$stmt = mysqli_prepare($conn, "UPDATE inquiry SET user_id = ?, type = ?, title = ?, content = ?, is_secret = ?, secret_password = ? WHERE id = ?");
mysqli_stmt_bind_param($stmt, "ssssisi", $userId, $type, $title, $content, $isSecret, $secretPassword, $inquiry_id);
$result = mysqli_stmt_execute($stmt);

// DELETE 기존 첨부파일
if (!empty($delete_files) && is_array($delete_files)) {
    $stmt_del = mysqli_prepare($conn, "DELETE FROM inquiry_images WHERE id = ?");
    foreach ($delete_files as $file_id) {
        mysqli_stmt_bind_param($stmt_del, "i", $file_id);
        mysqli_stmt_execute($stmt_del);
    }
    mysqli_stmt_close($stmt_del);
}

// 파일 업로드 처리
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'webp'];

for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
    $fileName = $_FILES['file']['name'][$i] ?? '';
    $tmpName = $_FILES['file']['tmp_name'][$i] ?? '';
    $error = $_FILES['file']['error'][$i];

    if ($fileName === '' || $error !== UPLOAD_ERR_OK) continue;

    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed_extensions)) {
        echo "<script>alert('허용되지 않은 파일 형식입니다.'); history.back();</script>";
        exit;
    }

    $uniqueFileName = uniqid() . '_' . basename($fileName);
    $uploadPath = '/var/www/html/inquiry_uploads/' . $uniqueFileName;

    if (move_uploaded_file($tmpName, $uploadPath)) {
        $image_url = '/inquiry_uploads/' . $uniqueFileName;
        $stmt_img = mysqli_prepare($conn, "INSERT INTO inquiry_images (inquiry_id, image_url) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt_img, "is", $inquiry_id, $image_url);
        mysqli_stmt_execute($stmt_img);
        mysqli_stmt_close($stmt_img);
    } else {
        echo "<script>alert('파일 업로드 실패'); history.back();</script>";
        exit;
    }
}

if ($result) {
    echo "<script>
        alert('문의가 수정되었습니다.');
        window.location.href = '/mainmenu/inquiry_detail.php?id=$inquiry_id';
    </script>";
} else {
    echo "<script>
        alert('문의 수정에 실패했습니다.');
        history.back();
    </script>";
}

mysqli_close($conn);
?>
