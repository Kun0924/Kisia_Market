<?php
// 세션 시작
session_start();
?>

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
                                <h3 class="profile-name">홍길동</h3>
                                <p class="profile-email">user@example.com</p>
                            </div>
                        </div>
                        
                        <ul class="mypage-menu">
                            <li><a href="#" data-section="order-section" class="active">주문/배송</a></li>
                            <li><a href="#" data-section="profile-edit-section">회원 정보 수정</a></li>
                            <li><a href="#" data-section="review-section">나의 리뷰</a></li>
                            <li><a href="#" data-section="inquiry-section">1:1 문의내역</a></li>
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

                    <!-- 회원 정보 수정 섹션 -->
                    <div class="mypage-section" id="profile-edit-section" style="display: none;">
                        <h3>회원 정보 수정</h3>
                        <div class="profile-edit-form">
                            <form>
                                <div class="form-group">
                                    <label for="name">이름</label>
                                    <input type="text" id="name" name="name" value="홍길동">
                                </div>
                                <div class="form-group">
                                    <label for="email">이메일</label>
                                    <input type="email" id="email" name="email" value="user@example.com">
                                </div>
                                <div class="form-group">
                                    <label for="phone">휴대폰 번호</label>
                                    <input type="tel" id="phone" name="phone" value="010-1234-5678">
                                </div>
                                <div class="form-group">
                                    <label for="address">주소</label>
                                    <input type="text" id="address" name="address" value="서울시 강남구 테헤란로 123">
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn-save">저장하기</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- 나의 리뷰 섹션 -->
                    <div class="mypage-section" id="review-section" style="display: none;">
                        <h3>나의 리뷰</h3>
                        <div class="review-list">
                            <!-- 리뷰 내역이 없을 경우 -->
                            <div class="empty-list">
                                <i class="fas fa-comment-alt"></i>
                                <p>작성한 리뷰가 없습니다.</p>
                            </div>
                        </div>
                    </div>

                    <!-- 1:1 문의내역 섹션 -->
                    <div class="mypage-section" id="inquiry-section" style="display: none;">
                        <h3>1:1 문의내역</h3>
                        <div class="inquiry-list">
                            <!-- 문의내역이 없을 경우 -->
                            <div class="empty-list">
                                <i class="fas fa-question-circle"></i>
                                <p>문의내역이 없습니다.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>

    <script>
        // 메뉴 클릭 시 해당 섹션 표시
        document.addEventListener('DOMContentLoaded', function() {
            const menuLinks = document.querySelectorAll('.mypage-menu a');
            const sections = document.querySelectorAll('.mypage-section');
            
            menuLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // 모든 메뉴에서 active 클래스 제거
                    menuLinks.forEach(item => item.classList.remove('active'));
                    
                    // 클릭한 메뉴에 active 클래스 추가
                    this.classList.add('active');
                    
                    // 모든 섹션 숨기기
                    sections.forEach(section => {
                        section.style.display = 'none';
                    });
                    
                    // 선택한 섹션 표시
                    const targetSection = document.getElementById(this.getAttribute('data-section'));
                    if (targetSection) {
                        targetSection.style.display = 'block';
                    }
                });
            });
        });
    </script>
</body>
</html> 