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

        <!-- DB 연결 -->
        <?php
        require_once 'mainmenu/common/db.php';

        $sql1 = "SELECT * FROM products LIMIT 3"; // 원하는 만큼 가져오기 (예: 3개)
        $result_best = mysqli_query($conn, $sql1);

        $sql2 = "SELECT * FROM products ORDER BY id DESC LIMIT 3"; // id 기준으로 오름차순으로 3개 가져오기
        $result_new = mysqli_query($conn, $sql2);

        // 데이터 복사해서 가져오기 (출력 아님, 그냥 콘솔에서 확인용)
        // $data = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
        // $jsonData = json_encode($data);
        // echo "<script>console.log(" . $jsonData . ");</script>";

        ?>

        <!-- 베스트 상품 -->
        <section class="best-products">
            <div class="container">
                <h2 class="section-title">베스트 상품</h2>
                <div class="product-grid">

                <?php
                if (mysqli_num_rows($result_best) > 0) {
                    while ($row_best = mysqli_fetch_assoc($result_best)) {
                        // 상품 하나당 하나의 카드 출력
                        echo '<div class="product-card">';
                        echo '<img src="' . htmlspecialchars($row_best['image_url']) . '" alt="' . htmlspecialchars($row_best['name']) . '">';
                        echo '<h3>' . htmlspecialchars($row_best['name']) . '</h3>';
                        echo '<p class="price">' . number_format($row_best['price']) . '원</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>등록된 상품이 없습니다.</p>';
                }
                ?>

                    <!-- <div class="product-card">
                        <img src="images/product1.jpg" alt="상품1">
                        <h3>상품명 1</h3>
                        <p class="price">10,000원</p>
                    </div>
                    <div class="product-card">
                        <img src="images/product2.jpg" alt="상품2">
                        <h3>상품명 2</h3>
                        <p class="price">20,000원</p>
                    </div>
                    <div class="product-card">
                        <img src="images/product3.jpg" alt="상품3">
                        <h3>상품명 3</h3>
                        <p class="price">30,000원</p>
                    </div> -->

                </div>
                
                <div class="view-more">
                    <a href="mainmenu/best.php" class="btn-view-more">더보기</a>
                </div>
            </div>
        </section>

        <!-- 신상품 -->
        <section class="new-products">
            <div class="container">
                <h2 class="section-title">신상품</h2>
                <div class="product-grid">
                    
                    <?php
                    if (mysqli_num_rows($result_new) > 0) {
                        while ($row_new = mysqli_fetch_assoc($result_new)) {
                            // 상품 하나당 하나의 카드 출력
                            echo '<div class="product-card">';
                            echo '<img src="' . htmlspecialchars($row_new['image_url']) . '" alt="' . htmlspecialchars($row_new['name']) . '">';
                            echo '<h3>' . htmlspecialchars($row_new['name']) . '</h3>';
                            echo '<p class="price">' . number_format($row_new['price']) . '원</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>등록된 상품이 없습니다.</p>';
                    }
                    ?>

                </div>
                <div class="view-more">
                    <a href="mainmenu/newproduct.php" class="btn-view-more">더보기</a>
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