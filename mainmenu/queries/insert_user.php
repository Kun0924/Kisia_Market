<?php
require_once '/var/www/html/mainmenu/common/db.php';

$userId = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

function isValidPassword($password) {
    // 영문 대/소문자, 숫자, 특수문자 각각 하나 이상 포함, 8~20자
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,20}$/', $password);
}

if (!isValidPassword($password)) {
    echo "<script>
        alert('비밀번호는 대/소문자, 숫자, 특수문자를 포함한 8~20자여야 합니다.');
        history.back();
    </script>";
    exit;
}

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
