<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>결제하기 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="checkout-container">
                <h2 class="page-title">결제하기</h2>
                
                <!-- 주문 상품 정보 -->
                <section class="checkout-section">
                    <h3 class="section-title">주문 상품 정보</h3>
                    <div class="order-summary">
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>상품정보</th>
                                    <th>수량</th>
                                    <th>상품금액</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <img src="images/product1.jpg" alt="상품 이미지" class="product-image">
                                            <a href="product-detail.php?id=1" class="product-name">상품명 1</a>
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>10,000원</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <img src="images/product2.jpg" alt="상품 이미지" class="product-image">
                                            <a href="product-detail.php?id=2" class="product-name">상품명 2</a>
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>15,000원</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <div class="order-summary-details">
                            <div class="summary-row">
                                <span class="summary-label">상품금액</span>
                                <span class="summary-value">25,000원</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">배송비</span>
                                <span class="summary-value">2,500원</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label summary-total">총 결제금액</span>
                                <span class="summary-value summary-total">27,500원</span>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- 배송 정보 -->
                <section class="checkout-section">
                    <h3 class="section-title">배송 정보</h3>
                    <form class="checkout-form">
                        <div class="form-group">
                            <label for="name">이름</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">휴대폰 번호</label>
                            <input type="tel" id="phone" name="phone" placeholder="010-0000-0000" required>
                        </div>
                        <div class="form-group">
                            <label for="email">이메일</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="address">주소</label>
                            <div class="address-input-group">
                                <input type="text" id="address" name="address" placeholder="주소" required>
                                <button type="button" class="btn-search-address">주소 검색</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address-detail">상세주소</label>
                            <input type="text" id="address-detail" name="address-detail" placeholder="상세주소를 입력하세요">
                        </div>
                        <div class="form-group">
                            <label for="delivery-memo">배송 메모</label>
                            <input type="text" id="delivery-memo" name="delivery-memo" placeholder="배송 시 요청사항을 입력하세요">
                        </div>
                    </form>
                </section>
                
                <!-- 결제 방법 -->
                <section class="checkout-section">
                    <h3 class="section-title">결제 방법</h3>
                    <div class="payment-methods">
                        <div class="payment-method">
                            <input type="radio" id="payment-card" name="payment" value="card" checked>
                            <label for="payment-card">신용/체크카드</label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" id="payment-bank" name="payment" value="bank">
                            <label for="payment-bank">계좌이체</label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" id="payment-vbank" name="payment" value="vbank">
                            <label for="payment-vbank">가상계좌</label>
                        </div>
                        <div class="payment-method">
                            <input type="radio" id="payment-phone" name="payment" value="phone">
                            <label for="payment-phone">휴대폰 결제</label>
                        </div>
                    </div>
                </section>
                
                <!-- 결제 버튼 -->
                <div class="checkout-actions">
                    <button class="btn-cancel">취소</button>
                    <button class="btn-payment">결제하기</button>
                </div>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>

    <script>
        // 주소 검색 버튼
        document.querySelector('.btn-search-address')?.addEventListener('click', function() {
            // 주소 검색 API 연동 (예: 카카오 주소 API)
            alert('주소 검색 기능은 별도 API 연동이 필요합니다.');
        });
        
        // 취소 버튼
        document.querySelector('.btn-cancel')?.addEventListener('click', function() {
            if(confirm('결제를 취소하시겠습니까?')) {
                window.location.href = 'cart.php';
            }
        });
        
        // 결제하기 버튼
        document.querySelector('.btn-payment')?.addEventListener('click', function() {
            // 결제 처리 로직
            alert('결제가 완료되었습니다.');
            window.location.href = 'order-complete.php';
        });
    </script>
</body>
</html> 