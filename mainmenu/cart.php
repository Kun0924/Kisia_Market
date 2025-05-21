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
    <?php require_once 'queries/get_cart_items.php'; ?>
    <?php mysqli_close($conn); ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="cart-container">
                <h2 class="page-title">장바구니</h2>
                
                <?php if (empty($cart_items)) : ?>
                    <div class="empty-cart">
                        <div class="empty-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <p class="empty-cart-message">장바구니가 비어있습니다.</p>
                        <a href="all.php" class="btn-shop">쇼핑하기</a>
                    </div>
                <?php else : ?>
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
                            <?php foreach ($cart_items as $item) : ?>
                            <tr data-cart-item-id="<?= $item['id'] ?>">
                                <td>
                                    <div class="product-info">
                                        <img src="<?php echo '/' . $item['image_url']; ?>" alt="상품 이미지" class="product-image">
                                        <a href="product_explain.php?id=<?php echo $item['product_id']; ?>" class="product-name"><?php echo $item['name']; ?></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="quantity-control">
                                        <button class="quantity-btn" data-action="decrease">-</button>
                                        <input type="number" class="quantity-input" value="<?php echo $item['quantity']; ?>" min="1" data-price="<?php echo $item['price']; ?>">
                                        <button class="quantity-btn" data-action="increase">+</button>
                                    </div>
                                </td>
                                <td class="product-price"><?php echo number_format($item['price'] * $item['quantity']); ?>원</td>
                                <td class="shipping-fee" data-price="<?php echo $item['deliver_price']; ?>"><?php echo number_format($item['deliver_price']); ?>원</td>
                                <td class="total-price"><?php echo number_format($item['price'] * $item['quantity'] + $item['deliver_price']); ?>원</td>
                                <td>
                                    <button class="remove-btn">삭제</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    
                    <div class="cart-summary">
                        <div class="summary-row">
                            <span class="summary-label">상품금액</span>
                            <span class="summary-value" id="subtotal"><?php echo number_format($subtotal); ?>원</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">배송비</span>
                            <span class="summary-value" id="shipping-total"><?php echo number_format($shippingTotal); ?>원</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label summary-total">총 결제금액</span>
                            <span class="summary-value summary-total" id="grand-total"><?php echo number_format($grandTotal); ?>원</span>
                        </div>
                    </div>
                    
                    <div class="cart-actions">
                        <button class="btn-continue">쇼핑 계속하기</button>
                        <button class="btn-checkout">주문하기</button>
                    </div>
                <?php endif; ?>
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
                const cartItemId = this.closest('tr').dataset.cartItemId;
                console.log(cartItemId);
                
                if (action === 'increase') {
                    fetch('/mainmenu/queries/update_cart_item.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `cart_item_id=${cartItemId}&quantity=${currentValue + 1}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log(data.result);
                            input.value = currentValue + 1;
                            updatePrices();
                        } else {
                            alert(data.message);
                        }
                    });
                } else if (action === 'decrease' && currentValue > 1) {
                    fetch('/mainmenu/queries/update_cart_item.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `cart_item_id=${cartItemId}&quantity=${currentValue - 1}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('장바구니 업데이트 성공');
                            input.value = currentValue - 1;
                            updatePrices();
                        } else {
                            alert(data.message);
                        }
                    });
                }
                
                // 가격 계산 로직
                updatePrices();
            });
        });
        
        // 삭제 버튼 기능
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const cartItemId = row.dataset.cartItemId;
                const id = '<?php echo $id; ?>';
                console.log(cartItemId);
                console.log(id);

                fetch('/mainmenu/queries/delete_cart_item.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `cart_item_id=${cartItemId}&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        row.remove();
                        updatePrices();
                        checkEmptyCart();
                    } else {
                        alert('삭제 실패');
                    }
                });
            });
        });
        
        // 쇼핑 계속하기 버튼
        document.querySelector('.btn-continue')?.addEventListener('click', function() {
            window.location.href = 'all.php';
        });
        
        // 주문하기 버튼
        document.querySelector('.btn-checkout')?.addEventListener('click', function() {
            window.location.href = 'checkout.php?type=cart';
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
                    const shippingFee = parseInt(row.querySelector('.shipping-fee').getAttribute('data-price')); // 각 상품당 배송비
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
                `
            }
        }
    </script>
</body>
</html> 