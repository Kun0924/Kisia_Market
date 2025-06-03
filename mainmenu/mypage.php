<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mypage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
    <?php
    $pages = [
        'mypage_profile.php' => 'mypage_profile.php',
        'mypage_order.php' => 'mypage_order.php',
        'mypage_review.php' => 'mypage_review.php',
        'mypage_inquiry.php' => 'mypage_inquiry.php'
    ];

    $page = $_GET['tab'] ?? 'mypage_profile.php';

    // php:// 등 우회 시도 차단
    if (preg_match('/php:\/\/|filter|base64/i', $page)) {
        exit('허용되지 않는 요청입니다.');
    }

    if (array_key_exists($page, $pages)) {
        include($pages[$page]);
    } else {
        include('../errorpage/404.php'); // 에러 처리
    }
    ?>
    </main>
    <?php include 'common/footer.php'; ?>
</body>
</html> 