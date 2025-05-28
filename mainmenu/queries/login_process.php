<?php
session_start();
require_once '/var/www/html/mainmenu/common/db.php';

$userId = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = $_POST['remember'] ?? '';

// 아이디로 사용자 정보만 가져오기 (비밀번호는 해시값으로 저장됨)
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE userId = ?");
mysqli_stmt_bind_param($stmt, "s", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    // 로그인 성공
    $_SESSION['id'] = $user['id'];
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    if ($remember) {
        setcookie('saved_id', $userId, time() + (86400 * 30), "/");
    } else {
        setcookie('saved_id', '', time() - 3600, "/");
    }

    if (isset($user['role']) && strtoupper($user['role']) === 'ADMIN') {
        header("Location: /admin/dashboard_main.php");
    } else {
        header("Location: /index.php");
    }
    exit;
} else {
    echo "<script>
        alert('아이디 또는 비밀번호가 잘못되었습니다.');
        window.location.href = '/mainmenu/login.php';
    </script>";
}

mysqli_close($conn);
?>
