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
    <?php require_once 'queries/get_mypage_inquiry.php'; ?>

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
                            <li><a href="mypage.php" data-section="order-section">주문/배송</a></li>
                            <li><a href="mypage_review.php" data-section="review-section">나의 리뷰</a></li>
                            <li><a href="mypage_inquiry.php" data-section="inquiry-section" class="active">1:1 문의내역</a></li>
                        </ul>
                    </div>
                    <!-- 1:1 문의내역 섹션 -->
                    <div class="mypage-section" id="inquiry-section">
                        <h3>1:1 문의내역</h3>
                        <div class="inquiry-list">
                            <!-- 문의내역이 없을 경우 -->
                            <?php if(empty($inquiry)) : ?>
                            <div class="empty-list">
                                <i class="fas fa-question-circle"></i>
                                <p>문의내역이 없습니다.</p>
                            </div>
                            <?php endif; ?>
                            <?php foreach($inquiry as $i) : ?>
                                <div class="inquiry-item">
                                    <div class="inquiry-header">
                                        <a href="inquiry_detail.php?id=<?php echo $i['id']; ?>">
                                            <h4>
                                                <?php if($i['is_secret']) echo '<i class="fas fa-lock"></i> '; ?>
                                                <?php echo $i['title']; ?>
                                            </h4>
                                        </a>
                                        <div class="inquiry-info-group">
                                            <span class="inquiry-type"><?php echo $i['type']; ?></span>
                                            <span class="inquiry-date"><?php echo date('Y-m-d', strtotime($i['created_at'])); ?></span>
                                            <?php if($i['inquiry_status'] == '답변 대기') : ?>
                                                <span class="inquiry-status">답변 대기</span>
                                            <?php elseif($i['inquiry_status'] == '답변 완료') : ?>
                                                <span class="inquiry-status_done">답변 완료</span>
                                            <?php endif; ?>

                                        </div>
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