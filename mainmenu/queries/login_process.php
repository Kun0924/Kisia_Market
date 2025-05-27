<?php
session_start();
require_once '/var/www/html/mainmenu/common/db.php';

$userId = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = $_POST['remember'] ?? '';

// 로그인 쿼리 (SQL Injection 방지 없이 단순 버전)
$sql = "SELECT * FROM users WHERE userId = '$userId' AND password = '$password'";
$result = mysqli_query($conn, $sql);
$user = $result ? mysqli_fetch_assoc($result) : null;

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

    // ✅ 진짜 핵심 부분: 대소문자 무시하고 'ADMIN'이면 관리자 페이지로 이동
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
