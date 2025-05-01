<?php 
$menu_path = '../';
include '../queries/get_header_session.php';
$current_path = '../'; // 상대 경로 설정
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KISIA SHOP - 마우스 상세</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/all.css">
    <link rel="stylesheet" href="explain.css"> <!-- 공통 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include '../common/header.php'; ?>
    <?php require_once '../queries/get_mouse_products.php'; ?>

    <main class="main-content">
        <div class="container">
            <?php
            if (isset($_GET['id'])) {
                $product_id = $_GET['id'];
                
                if (mysqli_num_rows($get_mouse_products) > 0) {
                    while ($row = mysqli_fetch_assoc($get_mouse_products)) {
                        if ($row['id'] == $product_id) {
                            echo '<div class="product-detail">';
                            echo '<div class="product-image">';
                            echo '<img src="../' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                            echo '</div>';
                            echo '<div class="product-info">';
                            echo '<h1>' . htmlspecialchars($row['name']) . '</h1>';
                            echo '<p class="price">' . number_format($row['price']) . '원</p>';
                            echo '<div class="button-group">';
                            echo '<button class="cart-btn"><i class="fas fa-shopping-cart"></i> 장바구니</button>';
                            echo '<button class="buy-btn">구매하기</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                            echo '<div class="tabs">';
                            echo '<button class="tab-btn active" onclick="openTab(\'description\', this)">상품 설명</button>';
                            echo '<button class="tab-btn" onclick="openTab(\'reviews\', this)">리뷰</button>';
                            echo '</div>';

                            echo '<div id="description" class="tab-content active">';
                            echo '<h2>상품 설명</h2>';
                            echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                            echo '</div>';

                            echo '<div id="reviews" class="tab-content">';
                            echo '<h2>리뷰</h2>';
                            include 'review_form.php';
                            echo '</div>';

                            break;
                        }
                    }
                }
            }
            ?>
        </div>
    </main>

    <?php include '../common/footer.php'; ?>
</body>
</html>
