<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>주문/배송 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="order-container">
                <h2 class="page-title">주문/배송 조회</h2>
                
                <!-- 주문 조회 폼 -->
                <div class="order-search">
                    <form class="order-search-form">
                        <div class="form-group">
                            <label for="order-number">주문번호</label>
                            <input type="text" id="order-number" name="order-number" placeholder="주문번호를 입력하세요" required>
                        </div>
                        <div class="form-group">
                            <label for="order-email">이메일</label>
                            <input type="email" id="order-email" name="order-email" placeholder="주문 시 입력한 이메일을 입력하세요" required>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-search">조회하기</button>
                        </div>
                    </form>
                </div>

                <!-- 주문 목록 -->
                <div class="order-list">
                    <h3>최근 주문 내역</h3>
                    <div class="order-item">
                        <div class="order-header">
                            <div class="order-info">
                                <span class="order-date">2024.03.15</span>
                                <span class="order-number">주문번호: 20240315-123456</span>
                            </div>
                            <div class="order-status">
                                <span class="status preparing">상품 준비중</span>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="product-info">
                                <img src="../images/product1.jpg" alt="상품 이미지">
                                <div class="product-details">
                                    <h4>상품명</h4>
                                    <p>수량: 1개</p>
                                    <p>가격: 29,000원</p>
                                </div>
                            </div>
                            <div class="delivery-info">
                                <h4>배송 정보</h4>
                                <p>받는 사람: 홍길동</p>
                                <p>연락처: 010-1234-5678</p>
                                <p>주소: 서울시 강남구 테헤란로 123</p>
                            </div>
                        </div>
                    </div>

                    <div class="order-item">
                        <div class="order-header">
                            <div class="order-info">
                                <span class="order-date">2024.03.10</span>
                                <span class="order-number">주문번호: 20240310-789012</span>
                            </div>
                            <div class="order-status">
                                <span class="status delivered">배송완료</span>
                            </div>
                        </div>
                        <div class="order-details">
                            <div class="product-info">
                                <img src="../images/product2.jpg" alt="상품 이미지">
                                <div class="product-details">
                                    <h4>상품명</h4>
                                    <p>수량: 2개</p>
                                    <p>가격: 58,000원</p>
                                </div>
                            </div>
                            <div class="delivery-info">
                                <h4>배송 정보</h4>
                                <p>받는 사람: 홍길동</p>
                                <p>연락처: 010-1234-5678</p>
                                <p>주소: 서울시 강남구 테헤란로 123</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 