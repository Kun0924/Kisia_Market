<?php
require_once '/var/www/html/mainmenu/common/db.php';

$userId = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// 이메일 중복 확인 (prepared statement 적용)
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$email_result = mysqli_stmt_get_result($stmt);
$email_row = mysqli_fetch_assoc($email_result);
mysqli_stmt_close($stmt);

if ($email_row) {
    echo "<script>alert('이미 사용중인 이메일입니다.'); history.back();</script>";
    exit;
}

// 회원가입 처리 (prepared statement 적용)
$stmt = mysqli_prepare($conn, "INSERT INTO users (userId, password, name, email, phone) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssss", $userId, $hashedPassword, $name, $email, $phone);
$result = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if ($result) {
    echo "<script>
        alert('회원가입이 완료되었습니다.');
        window.location.href = '/mainmenu/login.php';
    </script>";
} else {
    echo "<script>
        alert('회원가입에 실패했습니다.');
        history.back();
    </script>";
}

mysqli_close($conn);
?>
