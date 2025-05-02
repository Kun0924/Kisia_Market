<?php 
$menu_path = 'mainmenu/';
include '/var/www/html/mainmenu/queries/get_header_session.php'; 
?>
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

    <!-- DB 연결 -->
    <?php require_once 'mainmenu/queries/get_index_products.php';?>

    <!-- Main Content -->
    <main class="main-content">
        <!-- 메인 배너 -->
        <section class="main-banner">
            <div class="container">
                <div class="banner-content">
                    <h1>KISIA SHOP</h1>
                    <p>최고의 품질과 서비스를 제공합니다</p>
                </div>
            </div>
        </section>

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
                    <div class="product-grid">
                        <?php
                        if (mysqli_num_rows($get_keyboard_products) > 0) {
                            while ($row_best = mysqli_fetch_assoc($get_keyboard_products)) {
                                // 상품 하나당 하나의 카드 출력
                                echo '<div class="product-card">';
                                echo '<a href="mainmenu/product_explain.php?id=' . $row_best['id'] . '">';
                                echo '<img src="' . htmlspecialchars($row_best['image_url']) . '" alt="' . htmlspecialchars($row_best['name']) . '">';
                                echo '</a>';
                                echo '<h3>' . htmlspecialchars($row_best['name']) . '</h3>';
                                echo '<p class="price">' . number_format($row_best['price']) . '원</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>등록된 상품이 없습니다.</p>';
                        }
                        ?>
                    </div>
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
                    <div class="product-grid">
                        <?php
                        if (mysqli_num_rows($get_mouse_products) > 0) {
                            while ($row_best = mysqli_fetch_assoc($get_mouse_products)) {
                                // 상품 하나당 하나의 카드 출력
                                echo '<div class="product-card">';
                                echo '<a href="mainmenu/product_explain.php?id=' . $row_best['id'] . '">';
                                echo '<img src="' . htmlspecialchars($row_best['image_url']) . '" alt="' . htmlspecialchars($row_best['name']) . '">';
                                echo '</a>';
                                echo '<h3>' . htmlspecialchars($row_best['name']) . '</h3>';
                                echo '<p class="price">' . number_format($row_best['price']) . '원</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>등록된 상품이 없습니다.</p>';
                        }
                        ?>
                    </div>
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
                    <div class="product-grid">
                        <?php
                        if (mysqli_num_rows($get_mousepad_products) > 0) {
                            while ($row_best = mysqli_fetch_assoc($get_mousepad_products)) {
                                // 상품 하나당 하나의 카드 출력
                                echo '<div class="product-card">';
                                echo '<a href="mainmenu/product_explain.php?id=' . $row_best['id'] . '">';
                                echo '<img src="' . htmlspecialchars($row_best['image_url']) . '" alt="' . htmlspecialchars($row_best['name']) . '">';
                                echo '</a>';
                                echo '<h3>' . htmlspecialchars($row_best['name']) . '</h3>';
                                echo '<p class="price">' . number_format($row_best['price']) . '원</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>등록된 상품이 없습니다.</p>';
                        }
                        ?>
                    </div>
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
                    <div class="product-grid">
                        <?php
                        if (mysqli_num_rows($get_accessory_products) > 0) {
                            while ($row_best = mysqli_fetch_assoc($get_accessory_products)) {
                                // 상품 하나당 하나의 카드 출력
                                echo '<div class="product-card">';
                                echo '<a href="mainmenu/product_explain.php?id=' . $row_best['id'] . '">';
                                echo '<img src="' . htmlspecialchars($row_best['image_url']) . '" alt="' . htmlspecialchars($row_best['name']) . '">';
                                echo '</a>';
                                echo '<h3>' . htmlspecialchars($row_best['name']) . '</h3>';
                                echo '<p class="price">' . number_format($row_best['price']) . '원</p>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>등록된 상품이 없습니다.</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'mainmenu/common/footer.php'; ?>
</body>
</html> 