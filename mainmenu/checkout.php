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
    <?php require_once 'queries/get_mypage_user.php'; ?>
    <?php require_once 'queries/get_checkout_items.php'; ?>
    <?php mysqli_close($conn); ?>

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
                                <?php if ($type == 'cart') : ?>
                                <?php foreach ($cart_items as $item) : ?>
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <img src="/<?php echo $item['image_url']; ?>" alt="상품 이미지" class="product-image">
                                            <a href="product_explain.php?id=<?php echo $item['id']; ?>" class="product-name"><?php echo $item['name']; ?></a>
                                        </div>
                                    </td>
                                    <td><?php echo $item['quantity']; ?></td>
                                    <td><?php echo number_format($item['price']); ?>원</td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else : ?>
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <img src="/<?php echo $product['image_url']; ?>" alt="상품 이미지" class="product-image">
                                            <a href="product_explain.php?id=<?php echo $product['id']; ?>" class="product-name"><?php echo $product['name']; ?></a>
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td><?php echo number_format($product['price']); ?>원</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        
                        <div class="order-summary-details">
                            <div class="summary-row">
                                <span class="summary-label">상품금액</span>
                                <span class="summary-value"><?php echo number_format($subtotal); ?>원</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label">배송비</span>
                                <span class="summary-value"><?php echo number_format($shippingTotal); ?>원</span>
                            </div>
                            <div class="summary-row">
                                <span class="summary-label summary-total">총 결제금액</span>
                                <span class="summary-value summary-total"><?php echo number_format($grandTotal); ?>원</span>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- 배송 정보 -->
                <section class="checkout-section">
                    <h3 class="section-title">
                        배송 정보
                        <label style="font-size:15px; margin-left:10px;">
                            <input type="checkbox" id="sameAsUser" style="vertical-align:middle;">
                            로그인한 회원 정보와 동일
                        </label>
                    </h3>
                    <form class="checkout-form" id="checkoutForm" method="post" action="queries/insert_order.php">
                        <input type="hidden" name="type" value="<?php echo $type; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $_SESSION['name']; ?>">
                        <input type="hidden" name="order_amount" value="<?php echo $grandTotal; ?>">
                        <?php if ($type == 'cart') : ?>
                            <?php foreach ($cart_items as $item) : ?>
                            <input type="hidden" name="product_id[]" value="<?php echo $item['id']; ?>">
                            <input type="hidden" name="quantity[]" value="<?php echo $item['quantity']; ?>">
                            <input type="hidden" name="price[]" value="<?php echo $item['price']; ?>">
                            <input type="hidden" name="product_name[]" value="<?php echo $item['name']; ?>">
                            <input type="hidden" name="product_image_url[]" value="<?php echo $item['image_url']; ?>">
                            <input type="hidden" name="deliver_price[]" value="<?php echo $item['deliver_price']; ?>">
                            <?php endforeach; ?>
                        <?php else : ?>
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="price" value="<?php echo $product['price']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                            <input type="hidden" name="product_image_url" value="<?php echo $product['image_url']; ?>">
                            <input type="hidden" name="deliver_price" value="<?php echo $product['deliver_price']; ?>">
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="name">수령인 이름</label>
                            <input type="text" id="name" name="receiver_name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">휴대폰 번호</label>
                            <input type="tel" id="phone" name="receiver_phone" placeholder="010-0000-0000" required>
                        </div>
                        <div class="form-group">
                            <label for="email">이메일</label>
                            <input type="email" id="email" name="receiver_email" required>
                        </div>
                        <div class="form-group">
                            <label for="postcode">우편번호</label>
                            <div class="address-input-group">
                                <input type="text" id="postcode" name="receiver_postcode" placeholder="우편번호" readonly required>
                                <button type="button" class="btn-search-address">주소 검색</button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">주소</label>
                            <input type="text" id="address" name="receiver_address" placeholder="주소" readonly required>
                        </div>
                        <div class="form-group">
                            <label for="address-detail">상세주소</label>
                            <input type="text" id="address-detail" name="receiver_address_detail" placeholder="상세주소를 입력하세요">
                        </div>
                        <div class="form-group">
                            <label for="delivery-memo">배송 메모</label>
                            <input type="text" id="delivery-memo" name="delivery_memo" placeholder="배송 시 요청사항을 입력하세요">
                        </div>

                        <!-- 결제 방법 -->
                        <section class="checkout-section">
                            <h3 class="section-title">결제 방법</h3>
                            <div class="payment-methods">
                                <div class="payment-method">
                                    <input type="radio" id="payment-card" name="payment" value="point" checked>
                                    <label for="payment-card">
                                        포인트
                                        <span style="color:#1976d2; font-size:14px; margin-left:8px;">
                                            (사용 가능: <?php echo $user['point']; ?>P)
                                        </span>
                                    </label>
                                </div>
                                <div class="payment-method">
                                    <input type="radio" id="payment-bank" name="payment" value="bank_transfer">
                                    <label for="payment-bank">무통장 입금</label>
                                </div>
                            </div>
                            <!-- 무통장 입금 정보 -->
                            <div id="bank-info-section" style="display:none; margin-top:18px; border:1px solid #e0e0e0; border-radius:8px; padding:18px 16px; background:#fafbff;">
                                <div class="form-group">
                                    <label for="depositor-name">입금자명</label>
                                    <input type="text" id="depositor-name" name="depositor-name" placeholder="입금자명을 입력하세요">
                                </div>
                                <div class="form-group">
                                    <label for="bank-name">입금은행</label>
                                    <select id="bank-name" name="bank-name">
                                        <option value="국민은행:1234567890 홍길동">국민은행:1234567890 홍길동</option>
                                        <option value="신한은행:1234567890 홍길동">신한은행:1234567890 홍길동</option>
                                        <option value="우리은행:1234567890 홍길동">우리은행:1234567890 홍길동</option>
                                        <option value="하나은행:1234567890 홍길동">하나은행:1234567890 홍길동</option>
                                        <option value="농협은행:1234567890 홍길동">농협은행:1234567890 홍길동</option>
                                        <option value="카카오뱅크:1234567890 홍길동">카카오뱅크:1234567890 홍길동</option>
                                        <option value="기업은행:1234567890 홍길동">기업은행:1234567890 홍길동</option>
                                    </select>
                                </div>
                            </div>
                        </section>

                        <!-- 결제 버튼 -->
                        <div class="checkout-actions">
                            <button type="button" class="btn-cancel">취소</button>
                            <button type="submit" class="btn-payment">결제하기</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>

    <!-- 다음 우편번호 API 스크립트 추가 -->
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
        // 주소 검색 버튼
        document.querySelector('.btn-search-address')?.addEventListener('click', function() {
            new daum.Postcode({
                oncomplete: function(data) {
                    document.getElementById('postcode').value = data.zonecode;
                    document.getElementById('address').value = data.roadAddress || data.jibunAddress;
                    document.getElementById('address-detail').focus();
                }
            }).open();
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
            // alert('결제가 완료되었습니다.');
            window.location.href = 'order-complete.php';
        });

        const userInfo = {
            name: "<?php echo $user['name']; ?>",
            phone: "<?php echo $user['phone']; ?>",
            email: "<?php echo $user['email']; ?>",
            address: "<?php echo $user['address']; ?>",
            postcode: "<?php echo $user['postcode']; ?>",
            address_detail: "<?php echo $user['address_detail']; ?>"
        };

        document.getElementById('sameAsUser')?.addEventListener('change', function() {
            if(this.checked) {
                document.getElementById('name').value = userInfo.name;
                document.getElementById('phone').value = userInfo.phone;
                document.getElementById('email').value = userInfo.email;
                document.getElementById('postcode').value = userInfo.postcode;
                document.getElementById('address').value = userInfo.address;
                document.getElementById('address-detail').value = userInfo.address_detail;
            } else {
                document.getElementById('name').value = '';
                document.getElementById('phone').value = '';
                document.getElementById('email').value = '';
                document.getElementById('postcode').value = '';
                document.getElementById('address').value = '';
                document.getElementById('address-detail').value = '';
            }
        });

        // 결제 방법 라디오 버튼에 따라 무통장 입금 정보 표시
        document.querySelectorAll('input[name="payment"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const bankSection = document.getElementById('bank-info-section');
                if(document.getElementById('payment-bank').checked) {
                    bankSection.style.display = 'block';
                } else {
                    bankSection.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html> 