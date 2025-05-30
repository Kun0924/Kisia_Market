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

if (strlen($title) > 1000) {
    echo "<script>alert('제목은 1000자 이하로 입력해주세요.'); history.back();</script>";
    exit;
}

if (strlen($content) > 1000) {
    echo "<script>alert('내용은 1000자 이하로 입력해주세요.'); history.back();</script>";
    exit;
}

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

// 업로드 파일 유효성 검사
$uploadDir = '/var/www/html/inquiry_uploads';
$webPathPrefix = 'inquiry_uploads/';
$allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];
$uploadFiles = [];

if (isset($_FILES['file']['name'])) {
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
        if ($_FILES['file']['error'][$i] !== UPLOAD_ERR_OK) continue;

        $tmpName = $_FILES['file']['tmp_name'][$i];
        $fileName = basename($_FILES['file']['name'][$i]);
        $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed_ext)) {
            echo "<script>
                alert('허용되지 않은 파일 형식입니다. [허용 형식: " . implode(', ', $allowed_ext) . "]');
                history.back();
            </script>";
            exit;
        }

        $uniqueFileName = uniqid('inq_', true) . '.' . $ext;
        $destination = $uploadDir . '/' . $uniqueFileName;
        $image_url = $webPathPrefix . $uniqueFileName;

        $uploadFiles[] = [
            'tmp' => $tmpName,
            'dest' => $destination,
            'url' => $image_url
        ];
    }
}

// 첨부파일 저장 및 이미지 DB INSERT
foreach ($uploadFiles as $file) {
    if (move_uploaded_file($file['tmp'], $file['dest'])) {
        chmod($file['dest'], 0644);
        $stmt = mysqli_prepare($conn, "INSERT INTO inquiry_images (inquiry_id, image_url) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "is", $inquiry_id, $file['url']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
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
