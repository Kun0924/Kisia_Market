<?php
require_once '/var/www/html/mainmenu/common/db.php';

$type_map = [
    'order' => '주문/결제',
    'delivery' => '배송',
    'return' => '반품/교환',
    'product' => '상품',
    'etc' => '기타'
];

$type = $type_map[$_POST['category'] ?? ''] ?? '기타';
$title = trim($_POST['title'] ?? '');
$content = trim($_POST['content'] ?? '');
$isSecret = isset($_POST['isSecret']) ? 1 : 0;
$secretPassword = isset($_POST['secretPassword']) ? $_POST['secretPassword'] : '';
$userId = $_POST['id'] ?? '';

if ($title === '' || $content === '' || $userId === '') {
    echo "<script>alert('모든 필드를 입력해 주세요.'); history.back();</script>";
    exit;
}

// 비밀글 비밀번호는 해싱 (선택적)
if ($isSecret && $secretPassword !== '') {
    $secretPassword = password_hash($secretPassword, PASSWORD_DEFAULT);
}

// 1. 문의글 INSERT
$stmt = mysqli_prepare($conn, "INSERT INTO inquiry (user_id, type, title, content, is_secret, secret_password) VALUES (?, ?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssssis", $userId, $type, $title, $content, $isSecret, $secretPassword);
$result = mysqli_stmt_execute($stmt);
$inquiry_id = mysqli_insert_id($conn);
mysqli_stmt_close($stmt);

// 2. 파일 업로드 처리
$uploadDir = '/var/www/html/inquiry_uploads';
$webPathPrefix = '/inquiry_uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

$allowed_ext = ['jpg', 'jpeg', 'png', 'gif', 'pdf'];

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

    if (move_uploaded_file($tmpName, $destination)) {
        chmod($destination, 0644);
        $stmt = mysqli_prepare($conn, "INSERT INTO inquiry_images (inquiry_id, image_url) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "is", $inquiry_id, $image_url);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

// 3. 결과 처리
if ($result) {
    echo "<script>
        alert('문의가 완료되었습니다.');
        window.location.href = '/mainmenu/inquiry_list.php';
    </script>";
} else {
    echo "<script>
        alert('문의 등록에 실패했습니다.');
        history.back();
    </script>";
}

mysqli_close($conn);
?>
