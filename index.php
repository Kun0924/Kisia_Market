<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KISIA SHOP - 메인</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="mainmenu/css/style.css">
    <link rel="stylesheet" href="mainmenu/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'mainmenu/common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <!-- 메인 배너 -->
        <section class="main-banner">
            <div class="container">
                <div class="banner-content">
                    <h1>KISIA SHOP</h1>
                    <p>최고의 품질과 서비스를 제공합니다</p>
                    <a href="mainmenu/all.php" class="btn-shop">쇼핑하기</a>
                </div>
            </div>
        </section>
        
        <!-- 신상품 섹션 -->
        <section class="new-products-section">
            <div class="container">
                <div class="section-header">
                    <div class="section-title-container">
                        <h2 class="section-title">신상품</h2>
                        <div class="view-more">
                            <a href="mainmenu/newproduct.php" class="more">더 보기</a>
                        </div>
                    </div>
                    <p class="section-description">새롭게 입고된 상품을 만나보세요</p>

        <!-- 키보드 섹션 -->
        <section class="keyboard-section">
            <div class="container">
                <div class="section-header">
                    <div class="section-title-container">
                        <h2 class="section-title">키보드</h2>
                        <div class="view-more">
                            <a href="mainmenu/keyboard.php" class="more">더 보기</a>
                        </div>
                    </div>
                    <p class="section-description">최고의 키보드를 만나보세요</p>
                </div>
            </div>
        </section>

        <!-- 마우스 섹션 -->
        <section class="mouse-section">
            <div class="container">
                <div class="section-header">
                    <div class="section-title-container">
                        <h2 class="section-title">마우스</h2>
                        <div class="view-more">
                            <a href="mainmenu/mouse.php" class="more">더 보기</a>
                        </div>
                    </div>
                    <p class="section-description">최고의 마우스를 만나보세요</p>
                </div>
            </div>
        </section>

        <!-- 마우스 패드 섹션 -->
        <section class="mousepad-section">
            <div class="container">
                <div class="section-header">
                    <div class="section-title-container">
                        <h2 class="section-title">마우스 패드</h2>
                        <div class="view-more">
                            <a href="mainmenu/mousepad.php" class="more">더 보기</a>
                        </div>
                    </div>
                    <p class="section-description">최고의 마우스 패드를 만나보세요</p>
                </div>
            </div>
        </section>

        <!-- 악세서리 섹션 -->
        <section class="accessories-section">
            <div class="container">
                <div class="section-header">
                    <div class="section-title-container">
                        <h2 class="section-title">악세서리</h2>
                        <div class="view-more">
                            <a href="mainmenu/accessory.php" class="more">더 보기</a>
                        </div>
                    </div>
                    <p class="section-description">최고의 악세서리를 만나보세요</p>
                </div>
            </div>
        </section>


        <!-- 이벤트 배너 -->
        <section class="event-banner">
            <div class="container">
                <div class="banner-content">
                    <h2>특별 이벤트</h2>
                    <p>지금 구매하시면 20% 할인!</p>
                    <a href="mainmenu/all.php" class="btn-event">이벤트 보기</a>
                </div>
            </div>
        </section>
    </main>
    <?php
    mysqli_close($conn); // 연결 종료
    ?>

    <?php include 'mainmenu/common/footer.php'; ?>
</body>
</html> 