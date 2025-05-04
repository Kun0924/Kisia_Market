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
                            <li><a href="mypage.php" data-section="order-section" class="active">주문/배송</a></li>
                            <li><a href="mypage_profile.php" data-section="profile-edit-section">회원 정보 수정</a></li>
                            <li><a href="mypage_review.php" data-section="review-section">나의 리뷰</a></li>
                            <li><a href="mypage_inquiry.php" data-section="inquiry-section">1:1 문의내역</a></li>
                        </ul>
                    </div>

                    <!-- 주문/배송 조회 섹션 -->
                    <div class="mypage-section" id="order-section">
                        <h3>주문/배송 조회</h3>
                        <div class="order-list">
                            <!-- 주문 내역이 없을 경우 -->
                            <div class="empty-list">
                                <i class="fas fa-box-open"></i>
                                <p>주문 내역이 없습니다.</p>
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