<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 페이지 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'topbar.php'; ?>

        <?php
        require_once '../mainmenu/common/db.php';

        // 회원 수 조회
        $member_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM users"))[0];

        // 상품 수 조회
        $product_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM products"))[0];

        // 주문 수 조회
        $order_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM orders"))[0];

        // 총 매출 조회
        $total_sales = mysqli_fetch_row(mysqli_query($conn, "SELECT COALESCE(SUM(order_amount), 0) FROM orders WHERE order_status = 'paid'"))[0];

        // 리뷰 수 조회
        $review_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM reviews"))[0];

        // 문의사항 수 조회
        $inquiry_count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM inquiry"))[0];
        ?>

        <!-- 메인 콘텐츠 -->
        <div class="main-content">
            <header class="admin-header">
                <h1>대시보드</h1>
            </header>

            <!-- 통계 카드 -->
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3>총 회원</h3>
                    <p><?= number_format($member_count) ?>명</p>
                </div>
                <div class="stat-card">
                    <h3>총 상품</h3>
                    <p><?= number_format($product_count) ?>개</p>
                </div>
                <div class="stat-card">
                    <h3>총 주문</h3>
                    <p><?= number_format($order_count) ?>건</p>
                </div>
                <div class="stat-card">
                    <h3>총 매출</h3>
                    <p><?= number_format($total_sales) ?>원</p>
                </div>

                <div class="stat-card">
                    <h3>리뷰</h3>
                    <p><?= number_format($review_count) ?>건</p>
                </div>
                <div class="stat-card">
                    <h3>문의사항</h3>
                    <p><?= number_format($inquiry_count) ?>건</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
