<?php
session_start();

// 로그인 여부 확인
if (!isset($_SESSION['userId'])) {
    // echo "<script>alert('로그인이 필요합니다.'); location.href='/mainmenu/login.php';</script>";
    header('Location: /errorpage/404.php');
    exit;
}

// 관리자 권한 확인 (대소문자 구분 없이 'admin'만 허용)
if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    echo "<script>alert('관리자 권한이 필요합니다.'); location.href='/mainmenu/login.php';</script>";
    exit;
}
?>
