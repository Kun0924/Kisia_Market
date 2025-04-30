<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>

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
                
                <?php
                // 장바구니에 상품이 있는지 확인 (실제로는 세션이나 데이터베이스에서 확인)
                $hasItems = true; // 임의로 상품이 있다고 설정
                
                if (!$hasItems) {
                    // 장바구니가 비어있을 때
                    echo '<div class="empty-cart">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <p class="empty-cart-message">장바구니가 비어있습니다.</p>
                        <a href="all.php" class="btn-shop">쇼핑하기</a>
                    </div>';
                } else {
                    // 장바구니에 상품이 있을 때
                    echo '<table class="cart-table">
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
                                        <a href="product-detail.php?id=1" class="product-name">기계식 키보드 (갈축)</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity-control">
                                        <button class="quantity-btn" data-action="decrease">-</button>
                                        <input type="number" class="quantity-input" value="1" min="1" data-price="150000">
                                        <button class="quantity-btn" data-action="increase">+</button>
                                    </div>
                                </td>
                                <td class="product-price">150,000원</td>
                                <td class="shipping-fee">2,500원</td>
                                <td class="total-price">152,500원</td>
                                <td>
                                    <button class="remove-btn">삭제</button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="product-info">
                                        <img src="images/product2.jpg" alt="상품 이미지" class="product-image">
                                        <a href="product-detail.php?id=2" class="product-name">무선 마우스 (게이밍)</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity-control">
                                        <button class="quantity-btn" data-action="decrease">-</button>
                                        <input type="number" class="quantity-input" value="1" min="1" data-price="89000">
                                        <button class="quantity-btn" data-action="increase">+</button>
                                    </div>
                                </td>
                                <td class="product-price">89,000원</td>
                                <td class="shipping-fee">2,500원</td>
                                <td class="total-price">91,500원</td>
                                <td>
                                    <button class="remove-btn">삭제</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div class="cart-summary">
                        <div class="summary-row">
                            <span class="summary-label">상품금액</span>
                            <span class="summary-value" id="subtotal">239,000원</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">배송비</span>
                            <span class="summary-value" id="shipping-total">5,000원</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label summary-total">총 결제금액</span>
                            <span class="summary-value summary-total" id="grand-total">244,000원</span>
                        </div>
                    </div>
                    
                    <div class="cart-actions">
                        <button class="btn-continue">쇼핑 계속하기</button>
                        <button class="btn-checkout">주문하기</button>
                    </div>';
                }
                ?>
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
                const action = this.getAttribute('data-action');
                
                if (action === 'increase') {
                    input.value = currentValue + 1;
                } else if (action === 'decrease' && currentValue > 1) {
                    input.value = currentValue - 1;
                }
                
                // 가격 계산 로직
                updatePrices();
            });
        });
        
        // 삭제 버튼 기능
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                row.remove();
                
                // 가격 재계산 로직
                updatePrices();
                
                // 장바구니가 비어있는지 확인
                checkEmptyCart();
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
        
        // 가격 계산 함수
        function updatePrices() {
            let subtotal = 0;
            let shippingTotal = 0;
            
            // 각 상품의 가격 계산
            document.querySelectorAll('tr').forEach(row => {
                const quantityInput = row.querySelector('.quantity-input');
                if (quantityInput) {
                    const quantity = parseInt(quantityInput.value);
                    const price = parseInt(quantityInput.getAttribute('data-price'));
                    const shippingFee = 2500; // 각 상품당 배송비
                    
                    const productTotal = quantity * price;
                    const rowTotal = productTotal + shippingFee;
                    
                    // 각 행의 가격 업데이트
                    row.querySelector('.product-price').textContent = productTotal.toLocaleString() + '원';
                    row.querySelector('.shipping-fee').textContent = shippingFee.toLocaleString() + '원';
                    row.querySelector('.total-price').textContent = rowTotal.toLocaleString() + '원';
                    
                    subtotal += productTotal;
                    shippingTotal += shippingFee;
                }
            });
            
            // 총액 업데이트
            document.getElementById('subtotal').textContent = subtotal.toLocaleString() + '원';
            document.getElementById('shipping-total').textContent = shippingTotal.toLocaleString() + '원';
            document.getElementById('grand-total').textContent = (subtotal + shippingTotal).toLocaleString() + '원';
        }
        
        // 장바구니가 비어있는지 확인하는 함수
        function checkEmptyCart() {
            const rows = document.querySelectorAll('tbody tr');
            if (rows.length === 0) {
                // 장바구니가 비어있으면 빈 장바구니 메시지 표시
                const cartContainer = document.querySelector('.cart-container');
                cartContainer.innerHTML = `
                    <h2 class="page-title">장바구니</h2>
                    <div class="empty-cart">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <p class="empty-cart-message">장바구니가 비어있습니다.</p>
                        <a href="all.php" class="btn-shop">쇼핑하기</a>
                    </div>
                `;
            }
        }
    </script>
</body>
</html> 