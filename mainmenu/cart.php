<?php
// 세션 시작 (필요시)
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>장바구니 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="cart-container">
                <h2 class="page-title">장바구니</h2>
                
                <!-- 장바구니가 비어있을 때 -->
                <div class="empty-cart">
                    <div class="empty-cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <p class="empty-cart-message">장바구니가 비어있습니다.</p>
                    <a href="all.php" class="btn-shop">쇼핑하기</a>
                </div>
                
                <!-- 장바구니에 상품이 있을 때 (주석 처리) -->
                <!--
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>상품정보</th>
                            <th>수량</th>
                            <th>상품금액</th>
                            <th>배송비</th>
                            <th>합계</th>
                            <th>삭제</th>
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
                            <td>
                                <div class="quantity-control">
                                    <button class="quantity-btn">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1">
                                    <button class="quantity-btn">+</button>
                                </div>
                            </td>
                            <td>10,000원</td>
                            <td>2,500원</td>
                            <td>12,500원</td>
                            <td>
                                <button class="remove-btn">삭제</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="images/product2.jpg" alt="상품 이미지" class="product-image">
                                    <a href="product-detail.php?id=2" class="product-name">상품명 2</a>
                                </div>
                            </td>
                            <td>
                                <div class="quantity-control">
                                    <button class="quantity-btn">-</button>
                                    <input type="number" class="quantity-input" value="1" min="1">
                                    <button class="quantity-btn">+</button>
                                </div>
                            </td>
                            <td>15,000원</td>
                            <td>2,500원</td>
                            <td>17,500원</td>
                            <td>
                                <button class="remove-btn">삭제</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="cart-summary">
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
                
                <div class="cart-actions">
                    <button class="btn-continue">쇼핑 계속하기</button>
                    <button class="btn-checkout">주문하기</button>
                </div>
                -->
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>

    <script>
        // 수량 조절 기능
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentNode.querySelector('.quantity-input');
                const currentValue = parseInt(input.value);
                
                if (this.textContent === '+') {
                    input.value = currentValue + 1;
                } else if (this.textContent === '-' && currentValue > 1) {
                    input.value = currentValue - 1;
                }
                
                // 여기에 가격 계산 로직 추가
            });
        });
        
        // 삭제 버튼 기능
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                row.remove();
                
                // 여기에 가격 재계산 로직 추가
            });
        });
        
        // 쇼핑 계속하기 버튼
        document.querySelector('.btn-continue')?.addEventListener('click', function() {
            window.location.href = 'all.php';
        });
        
        // 주문하기 버튼
        document.querySelector('.btn-checkout')?.addEventListener('click', function() {
            window.location.href = 'checkout.php';
        });
    </script>
</body>
</html> 