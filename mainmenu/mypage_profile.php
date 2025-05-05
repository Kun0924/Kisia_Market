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
    <?php require_once 'queries/get_mypage_user.php'; ?>
    <?php mysqli_close($conn); ?>

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
                                <h3 class="profile-name"><?php echo $user['name']; ?></h3>
                                <p class="profile-email"><?php echo $user['email']; ?></p>
                            </div>
                        </div>
                        
                        <ul class="mypage-menu">
                            <li><a href="mypage.php" data-section="order-section">주문/배송</a></li>
                            <li><a href="mypage_profile.php" data-section="profile-edit-section" class="active">회원 정보 수정</a></li>
                            <li><a href="mypage_review.php" data-section="review-section">나의 리뷰</a></li>
                            <li><a href="mypage_inquiry.php" data-section="inquiry-section">1:1 문의내역</a></li>
                        </ul>
                    </div>

                    <!-- 회원 정보 수정 섹션 -->
                    <div class="mypage-section" id="profile-edit-section">
                        <h3>회원 정보 수정</h3>
                        <div class="profile-edit-form">
                            <form action="queries/update_user.php" method="POST">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="form-group">
                                    <label for="name">이름</label>
                                    <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">이메일</label>
                                    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="phone">휴대폰 번호</label>
                                    <input type="tel" id="phone" name="phone" value="<?php echo $user['phone']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="postcode">우편번호</label>
                                    <div style="display:flex; gap:8px;">
                                        <input type="text" id="postcode" name="postcode" value="<?php echo isset($user['postcode']) ? $user['postcode'] : ''; ?>" placeholder="우편번호" readonly style="flex:1;">
                                        <button type="button" id="btn-search-address" style="flex:none; padding:8px 14px;">주소 검색</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">주소</label>
                                    <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" placeholder="주소" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="address_detail">상세주소</label>
                                    <input type="text" id="address_detail" name="address_detail" value="<?php echo isset($user['address_detail']) ? $user['address_detail'] : ''; ?>" placeholder="상세주소를 입력하세요">
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-save">저장하기</button>
                                </div>
                            </form>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script>
    document.getElementById('btn-search-address')?.addEventListener('click', function() {
        new daum.Postcode({
            oncomplete: function(data) {
                document.getElementById('postcode').value = data.zonecode;
                document.getElementById('address').value = data.roadAddress || data.jibunAddress;
                document.getElementById('address_detail').focus();
            }
        }).open();
    });
    </script>
</body>
</html> 