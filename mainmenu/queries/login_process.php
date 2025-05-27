<?php
session_start();
require_once '/var/www/html/mainmenu/common/db.php';

$userId = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = $_POST['remember'] ?? '';

$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE userId = ? AND password = ?");
mysqli_stmt_bind_param($stmt, "ss", $userId, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user) {
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
    // 오류 페이지로 이동가능?
    echo "<script>
        alert('아이디 또는 비밀번호가 잘못되었습니다.');
        window.location.href = '/mainmenu/login.php';
    </script>";
}
mysqli_close($conn);
?>
