<?php
session_start();
require_once '/var/www/html/mainmenu/common/db.php';

$userId = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$remember = $_POST['remember'] ?? '';

// 로그인 시도 제한 초기화
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

// 로그인 차단 조건 확인
if ($_SESSION['login_attempts'] >= 5 && (time() - $_SESSION['last_attempt_time']) < 180) {
    echo "<script>
        alert('로그인 시도 5회를 초과했습니다. 3분 후 다시 시도해주세요.');
        window.location.href = '/mainmenu/login.php';
    </script>";
    exit;
}

// DB에서 사용자 정보 조회
$stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE userId = ?");
mysqli_stmt_bind_param($stmt, "s", $userId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($password, $user['password'])) {
    // 로그인 성공 시 세션 재생성
    session_regenerate_id(true);

    // 로그인 정보 세션 저장
    $_SESSION['id'] = $user['id'];
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    // 로그인 시도 수 초기화
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = 0;

    // 저장된 아이디 쿠키 설정
    if ($remember) {
        setcookie('saved_id', $userId, time() + (86400 * 30), "/");
    } else {
        setcookie('saved_id', '', time() - 3600, "/");
    }

    // 리디렉션
    if (strtoupper($user['role']) === 'ADMIN') {
        header("Location: /admin/dashboard_main.php");
    } else {
        header("Location: /index.php");
    }
    exit;
} else {
    // 실패 시 로그인 시도 횟수 증가
    $_SESSION['login_attempts']++;
    $_SESSION['last_attempt_time'] = time();

    echo "<script>
        alert('아이디 또는 비밀번호가 잘못되었습니다.');
        window.location.href = '/mainmenu/login.php';
    </script>";
}

mysqli_close($conn);
?>
