<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>주문상세 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .order-detail-container { max-width: 700px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); padding: 32px 28px; }
        .order-detail-title { text-align: center; margin-bottom: 24px; color: #333; }
        .order-info-table, .order-product-table { width: 100%; border-collapse: collapse; margin-bottom: 24px; }
        .order-info-table th, .order-info-table td, .order-product-table th, .order-product-table td { padding: 10px 8px; border-bottom: 1px solid #eee; }
        .order-info-table th { width: 120px; background: #f7f7f7; text-align: left; }
        .order-product-table th { background: #f7f7f7; }
        .product-thumb img { width: 64px; height: 64px; object-fit: cover; border-radius: 8px; background: #f4f4f4; }
        .order-section-title { font-size: 18px; font-weight: 600; margin: 24px 0 12px 0; }
        .order-summary-row { display: flex; justify-content: flex-end; gap: 24px; font-size: 16px; }
        .order-summary-row .label { color: #888; }
        .order-summary-row .value { font-weight: 600; color: #1976d2; }
        .btn-back { display: inline-block; margin-top: 24px; background: #1976d2; color: #fff; padding: 10px 28px; border-radius: 5px; text-decoration: none; }
        .btn-back:hover { background: #1256a3; }
        .btn-cancel { display: inline-block; margin-top: 24px; background: #dc3545; color: #fff; padding: 10px 28px; border-radius: 5px; text-decoration: none; }
        .btn-cancel:hover { background:rgb(113, 20, 29); }
        .product-info-row { display: flex; align-items: center; gap: 12px; }
        .product-name { font-weight: 500; }
    </style>
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_mypage_order_detail.php'; ?>

    <main class="main-content">
        <div class="order-detail-container">
            <h2 class="order-detail-title">주문 상세내역</h2>

            <!-- 주문 정보 -->
            <div class="order-section-title">주문 정보</div>
            <table class="order-info-table">
                <tr>
                    <th>주문번호</th>
                    <td><?php echo $order['id']; ?></td>
                </tr>
                <tr>
                    <th>주문일자</th>
                    <td><?php echo $order['order_created_at']; ?></td>
                </tr>
                <tr>
                    <th>주문상태</th>
                    <td>
                        <?php
                        switch($order['order_status']) {
                            case 'paid': echo '결제완료'; break;
                            case 'pending': echo '결제대기'; break;
                            case 'cancelled': echo '취소'; break;
                            case 'shipping': echo '배송중'; break;
                            case 'complete': echo '배송완료'; break;
                            default: echo $order['order_status'];
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>결제수단</th>
                    <td>
                        <?php
                        if ($order['payment_method'] === 'point') echo '포인트';
                        else if ($order['payment_method'] === 'bank_transfer') echo '무통장 입금';
                        else echo $order['payment_method'];
                        ?>
                    </td>
                </tr>
                <?php if ($order['payment_method'] === 'bank_transfer'): ?>
                <tr>
                    <th>입금자명</th>
                    <td><?php echo $order['depositor_name']; ?></td>
                </tr>
                <tr>
                    <th>입금은행</th>
                    <td><?php echo $order['bank_name']; ?></td>
                </tr>
                <tr>
                    <th>입금확인</th>
                    <td><?php echo $order['deposit_confirmed'] ? '완료' : '대기중'; ?></td>
                </tr>
                <?php endif; ?>
            </table>

            <!-- 주문 상품 목록 -->
            <div class="order-section-title">주문 상품</div>
            <table class="order-product-table">
                <thead>
                    <tr>
                        <th>상품정보</th>
                        <th>수량</th>
                        <th>상품금액</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items as $item): ?>
                    <tr>
                        <td>
                            <div class="product-info-row">
                                <span class="product-thumb">
                                    <img src="/<?php echo $item['product_image_url']; ?>" alt="상품 이미지">
                                </span>
                                <span class="product-name"><?php echo $item['product_name']; ?></span>
                            </div>
                        </td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo number_format($item['price']); ?>원</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- 결제 요약 -->
            <div style="margin-top:20px; margin-bottom:20px; padding-top:15px; border-top:1px solid #eee;">
                <div class="order-summary-row" style="margin-bottom:8px;">
                    <span class="label" style="flex:1; text-align:right; margin-right:20px;">총 상품금액</span>
                    <span class="value" style="width:120px; text-align:right;"><?php echo number_format($subtotal); ?>원</span>
                </div>
                <div class="order-summary-row" style="margin-bottom:8px;">
                    <span class="label" style="flex:1; text-align:right; margin-right:20px;">배송비</span>
                    <span class="value" style="width:120px; text-align:right;"><?php echo number_format($shippingTotal); ?>원</span>
                </div>
                <div class="order-summary-row" style="margin-top:15px; padding-top:15px;">
                    <span class="label" style="flex:1; text-align:right; margin-right:20px; font-weight:bold; font-size:16px;">총 결제금액</span>
                    <span class="value" style="width:120px; text-align:right; font-size:18px; color:#e91e63; font-weight:bold;"><?php echo number_format($order['order_amount']); ?>원</span>
                </div>
            </div>

            <!-- 배송 정보 -->
            <div class="order-section-title">배송 정보</div>
            <table class="order-info-table">
                <tr>
                    <th>수령인</th>
                    <td><?php echo $order['receiver_name']; ?></td>
                </tr>
                <tr>
                    <th>연락처</th>
                    <td><?php echo $order['receiver_phone']; ?></td>
                </tr>
                <tr>
                    <th>이메일</th>
                    <td><?php echo $order['receiver_email']; ?></td>
                </tr>
                <tr>
                    <th>주소</th>
                    <td>
                        (<?php echo $order['receiver_postcode']; ?>)
                        <?php echo $order['receiver_address']; ?>
                        <?php if (!empty($order['receiver_address_detail'])): ?>
                            <?php echo $order['receiver_address_detail']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>배송메모</th>
                    <td><?php echo $order['delivery_memo']; ?></td>
                </tr>
            </table>

            <div class="button-group" style="display: flex; gap: 10px; justify-content: space-between; margin-top: 20px;">
                <a href="mypage.php" class="btn-back">목록으로</a>
                <form action="queries/cancel_order.php" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $order['user_id']; ?>">
                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                    <input type="hidden" name="price" value="<?php echo $order['order_amount']; ?>">
                    <input type="hidden" name="payment_method" value="<?php echo $order['payment_method']; ?>">
                    <a class="btn-cancel" onclick="this.closest('form').submit();" style="background-color: #dc3545; color: white;">주문 취소</a>
                </form>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 