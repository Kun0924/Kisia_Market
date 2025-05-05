<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>마이페이지 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/mypage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php include 'queries/get_mypage_order_list.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="mypage-container">
                <h2 class="page-title">마이페이지</h2>
                
                <!-- 사이드 메뉴 -->
                <div class="mypage-content">
                    <div class="mypage-sidebar">
                        <!-- 프로필 섹션 추가 -->
                        <div class="profile-section">
                            <div class="profile-image">
                                <img src="profile/default-profile.svg" alt="프로필 이미지">
                            </div>
                            <div class="profile-info">
                                <h3 class="profile-name"><?php echo $name; ?></h3>
                                <p class="profile-email"><?php echo $email; ?></p>
                            </div>
                        </div>
                        
                        <ul class="mypage-menu">
                            <li><a href="mypage_profile.php" data-section="profile-edit-section">회원 정보</a></li>
                            <li><a href="mypage.php" data-section="order-section" class="active">주문/배송</a></li>
                            <li><a href="mypage_review.php" data-section="review-section">나의 리뷰</a></li>
                            <li><a href="mypage_inquiry.php" data-section="inquiry-section">1:1 문의내역</a></li>
                        </ul>
                    </div>

                    <!-- 주문/배송 조회 섹션 -->
                    <div class="mypage-section" id="order-section">
                        <h3>주문/배송 조회</h3>
                        <div class="order-list">
                            <!-- 주문 내역이 없을 경우 -->
                            <?php if (empty($orders)) : ?>
                            <div class="empty-list">
                                <i class="fas fa-box-open"></i>
                                <p>주문 내역이 없습니다.</p>
                            </div>
                            <?php else : ?>
                            <?php foreach ($orders as $order) : ?>
                            <div class="order-item">
                                <div class="order-header">
                                    <div>
                                        <span class="order-num">주문번호: <?php echo $order['id']; ?></span>
                                        <span class="order-date"><?php echo $order['order_created_at']; ?></span>
                                    </div>
                                    <?php if ($order['order_status'] == 'pending') : ?>
                                        <span class="order-status status-pending">결제대기</span>
                                    <?php elseif ($order['order_status'] == 'paid') : ?>
                                        <span class="order-status status-paid">결제완료</span>
                                    <?php elseif ($order['order_status'] == 'cancelled') : ?>
                                        <span class="order-status status-cancelled">주문취소</span>
                                    <?php endif; ?>
                                </div>
                                <div class="order-products">
                                    <div class="product-thumb">
                                        <img src="/<?php echo $order['product_image_url']; ?>" alt="상품이미지">
                                    </div>
                                    <div class="product-info">
                                        <div class="product-name">
                                            <?php echo $order['product_name']; ?>
                                            <?php if ($order['item_count'] > 1): ?>
                                                <span style="color:#888; font-size:14px;">
                                                    외 <?php echo $order['item_count'] - 1; ?>개
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="product-option">수량: <?php echo $order['quantity']; ?></div>
                                        <div class="product-price"><?php echo number_format($order['price']); ?>원</div>
                                    </div>
                                </div>
                                <div class="order-footer">
                                    <div class="order-total">
                                        총 결제금액 <span><?php echo number_format($order['order_amount']); ?>원</span>
                                    </div>
                                    <?php if ($order['order_status'] !== 'cancelled') : ?>
                                        <a href="order_detail.php?order_id=<?php echo $order['id']; ?>" class="btn-detail">상세보기</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="pagination" id="pagination">
                            <?php
                                for ($i = 1; $i <= $total_pages; $i++) {
                                    $active = $i == $page ? 'active' : '';
                                    echo "<a href='?page=$i' class='$active'>$i</a>";
                                }
                                if ($page < $total_pages) {
                                    $next_page = $page + 1;
                                    echo "<a href='?page=$next_page' class='next'>다음 <i class='fas fa-chevron-right'></i></a>";
                                }
                            ?>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include 'common/footer.php'; ?>
</body>
</html> 