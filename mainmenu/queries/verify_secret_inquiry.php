<?php
require_once '/var/www/html/mainmenu/common/db.php';

$inquiry_id = $_POST['inquiry_id'] ?? '';
$secret_password = $_POST['secret_password'] ?? '';

// 유효성 검사
if (!is_numeric($inquiry_id) || empty($secret_password)) {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit;
}

// Prepared Statement로 SQL 인젝션 방지
$stmt = mysqli_prepare($conn, "SELECT secret_password FROM inquiry WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $inquiry_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

if ($row && $row['secret_password'] === $secret_password) {
    echo "<script>
        alert('비밀번호가 확인되었습니다.');
        window.location.href = '/mainmenu/inquiry_detail.php?id=$inquiry_id';
    </script>";
} else {
    echo "<script>
        alert('비밀번호가 틀렸습니다.');
        history.back();
    </script>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
