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
    <?php require_once 'queries/get_mypage_review.php'; ?>

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
                            <li><a href="mypage.php" data-section="order-section">주문/배송</a></li>
                            <li><a href="mypage_profile.php" data-section="profile-edit-section">회원 정보 수정</a></li>
                            <li><a href="mypage_review.php" data-section="review-section" class="active">나의 리뷰</a></li>
                            <li><a href="mypage_inquiry.php" data-section="inquiry-section">1:1 문의내역</a></li>
                        </ul>
                    </div>
                    
                    <!-- 나의 리뷰 섹션 -->
                    <div class="mypage-section" id="review-section">
                        <h3>나의 리뷰</h3>
                        <div class="review-list">
                            <!-- 리뷰 내역이 없을 경우 -->
                            <?php if(empty($review)) : ?>
                            <div class="empty-list">
                                <i class="fas fa-comment-alt"></i>
                                <p>작성한 리뷰가 없습니다.</p>
                            </div>
                            <?php endif; ?>
                            <?php foreach($review as $r) : ?>
                                <div class="review-item">
                                    <div class="review-header">
                                        <img src="/<?php echo $r['image_url']; ?>" alt="상품 이미지">
                                        <a href="product_explain.php?id=<?php echo $r['product_id']; ?>"><h4><?php echo $r['name']; ?></h4></a>
                                        <span class="review-rating"><?php echo str_repeat('★', $r['rating']) . str_repeat('☆', 5 - $r['rating']); ?></span>
                                        <span class="review-date"><?php echo $r['created_at']; ?></span>
                                    </div>
                                    <div class="review-content">
                                        <p><?php echo $r['content']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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