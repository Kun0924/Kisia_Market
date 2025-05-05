<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>주문 완료 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/order-complete.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="order-complete-container">
            <i class="fas fa-check-circle order-complete-icon"></i>
            <h1 class="order-complete-title">주문이 완료되었습니다!</h1>
            <p class="order-complete-message">주문해 주셔서 감사합니다. 주문 내역은 마이페이지에서 확인하실 수 있습니다.</p>
            <div class="order-complete-actions">
                <button class="btn-order-detail" onclick="location.href='mypage.php'">주문 상세 보기</button>
                <button class="btn-continue-shopping" onclick="location.href='all.php'">쇼핑 계속하기</button>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'common/footer.php'; ?>
</body>
</html> 