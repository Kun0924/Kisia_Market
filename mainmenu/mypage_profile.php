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
                            <li><a href="mypage_profile.php" data-section="profile-edit-section" class="active">회원 정보</a></li>
                            <li><a href="mypage.php" data-section="order-section">주문/배송</a></li>
                            <li><a href="mypage_review.php" data-section="review-section">나의 리뷰</a></li>
                            <li><a href="mypage_inquiry.php" data-section="inquiry-section">1:1 문의내역</a></li>
                        </ul>
                    </div>

                    <div class="mypage-section" id="point-section">
                        <h3>포인트</h3>

                        <div class="user-stats">
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value"><?php echo isset($order_count) ? number_format($order_count) : '0'; ?></div>
                                    <div class="stat-label">총 주문 횟수</div>
                                </div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="stat-value"><?php echo isset($shipping_count) ? number_format($shipping_count) : '0'; ?></div>
                                    <div class="stat-label">배송중인 상품</div>
                                </div>
                            </div>
                        </div>

                        <div class="point-container">
                            <div class="current-point">
                                <div class="point-label">현재 보유 포인트</div>
                                <div class="point-value"><?php echo number_format($user['point']); ?> P</div>
                            </div>
                            <button id="btnChargePoint" class="btn-charge-point">포인트 충전</button>
                        </div>
                        
                        <!-- 충전 폼 (초기에는 숨겨진 상태) -->
                        <div id="pointChargeForm" class="point-charge-form" style="display:none;">
                            <div class="form-header">포인트 충전하기</div>
                            <div style="color: #666; font-size: 14px; margin-bottom: 15px;">* 천원 단위로만 충전이 가능합니다.</div>
                            <form action="queries/charge_point.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                <div class="charge-options">
                                    <div class="charge-option">
                                        <input type="radio" id="amount10000" name="charge_amount" value="10000">
                                        <label for="amount10000">10,000P</label>
                                    </div>
                                    <div class="charge-option">
                                        <input type="radio" id="amount30000" name="charge_amount" value="30000">
                                        <label for="amount30000">30,000P</label>
                                    </div>
                                    <div class="charge-option">
                                        <input type="radio" id="amount50000" name="charge_amount" value="50000">
                                        <label for="amount50000">50,000P</label>
                                    </div>
                                    <div class="charge-option">
                                        <input type="radio" id="amount100000" name="charge_amount" value="100000">
                                        <label for="amount100000">100,000P</label>
                                    </div>
                                    <div class="charge-option">
                                        <input type="radio" id="amountCustom" name="charge_amount" value="custom">
                                        <label for="amountCustom">직접입력</label>
                                        <input type="number" id="customAmount" class="custom-amount" name="custom_amount" placeholder="충전할 금액을 입력하세요" min="1000" step="1000" disabled>
                                    </div>
                                </div>
                                <div class="charge-actions">
                                    <button type="submit" class="btn-submit-charge">충전하기</button>
                                    <button type="button" id="btnCancelCharge" class="btn-cancel-charge">취소</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- 회원 정보 수정 섹션 -->
                    <div class="mypage-section" id="profile-edit-section">
                        <h3>회원 정보</h3>
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
                            <div class="withdrawal-section">
                                <form action="queries/delete_user.php" method="POST">
                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                                    <button type="submit" class="btn-withdrawal" onclick="return confirm('정말로 탈퇴하시겠습니까? 이 작업은 되돌릴 수 없습니다.')">회원 탈퇴</button>
                                </form>
                            </div>
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
    <script>
        // 충전 버튼 클릭 시 폼 표시
        document.getElementById('btnChargePoint').addEventListener('click', function() {
            document.getElementById('pointChargeForm').style.display = 'block';
        });

        // 취소 버튼 클릭 시 폼 숨김
        document.getElementById('btnCancelCharge').addEventListener('click', function() {
            document.getElementById('pointChargeForm').style.display = 'none';
        });

        // 직접입력 선택 시만 직접입력 필드 활성화
        document.querySelectorAll('input[name="charge_amount"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const customAmountField = document.getElementById('customAmount');
                if (this.value === 'custom' && this.checked) {
                    customAmountField.disabled = false;
                    customAmountField.focus();
                } else {
                    customAmountField.disabled = true;
                }
            });
        });
    </script>
</body>
</html> 