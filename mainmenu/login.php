<?php
// 세션 시작 (로그인 처리를 나중에 추가할 때 필요함)
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그인 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="login-container">
                <h2 class="page-title">로그인</h2>
                <!-- 여기를 고침 예전 코드는 주석 처리-->
                <!-- <form class="login-form" method="POST" action="login_process.php"> -->

                <form class="login-form" onsubmit="return validateLogin()">
                    <div class="form-group">
                        <label for="username">아이디</label>
                        <input type="text" id="username" name="username" placeholder="아이디를 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요" required>
                    </div>
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">로그인 상태 유지</label>
                        </div>
                        <div class="find-links">
                            <a href="find_id.php">아이디 찾기</a>
                            <span class="divider">|</span>
                            <a href="find_password.php">비밀번호 찾기</a>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-login">로그인</button>
                    </div>
                </form>
                <div class="signup-link">
                    <p>아직 회원이 아니신가요? <a href="signup.php">회원가입</a></p>
                </div>
            </div>
        </div>
    </main>

    <!-- Signup Modal -->
    <div id="signupModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeSignupModal()">&times;</span>
            <h2 class="page-title">회원가입</h2>
            <form class="signup-form">
                <div class="form-group">
                    <label for="signup-username">아이디</label>
                    <input type="text" id="signup-username" name="username" placeholder="아이디를 입력하세요" required>
                </div>
                <div class="form-group">
                    <label for="signup-password">비밀번호</label>
                    <input type="password" id="signup-password" name="password" placeholder="비밀번호를 입력하세요" required>
                </div>
                <div class="form-group">
                    <label for="signup-name">이름</label>
                    <input type="text" id="signup-name" name="name" placeholder="이름을 입력하세요" required>
                </div>
                <div class="form-group">
                    <label for="signup-email">이메일</label>
                    <input type="email" id="signup-email" name="email" placeholder="이메일을 입력하세요" required>
                </div>
                <div class="form-group">
                    <label for="signup-phone">휴대폰 번호</label>
                    <input type="tel" id="signup-phone" name="phone" placeholder="휴대폰 번호를 입력하세요" required>
                </div>
                <div class="terms-section">
                    <div class="terms-group">
                        <label class="terms-all">
                            <input type="checkbox" id="terms-all" name="terms-all">
                            <span>전체 동의</span>
                        </label>
                    </div>
                    <div class="terms-group">
                        <label class="terms-item">
                            <input type="checkbox" id="terms-service" name="terms-service" required>
                            <span>이용약관 동의 (필수)</span>
                        </label>
                        <a href="terms.html" class="terms-link">약관보기</a>
                    </div>
                    <div class="terms-group">
                        <label class="terms-item">
                            <input type="checkbox" id="terms-privacy" name="terms-privacy" required>
                            <span>개인정보 수집 및 이용 동의 (필수)</span>
                        </label>
                        <a href="privacy.html" class="terms-link">약관보기</a>
                    </div>
                    <div class="terms-group">
                        <label class="terms-item">
                            <input type="checkbox" id="terms-marketing" name="terms-marketing">
                            <span>마케팅 정보 수신 동의 (선택)</span>
                        </label>
                        <a href="marketing.html" class="terms-link">약관보기</a>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-signup">가입하기</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openSignupModal() {
            document.getElementById('signupModal').style.display = 'block';
        }

        function closeSignupModal() {
            document.getElementById('signupModal').style.display = 'none';
        }

        // 모달 외부 클릭 시 닫기
        window.onclick = function(event) {
            var modal = document.getElementById('signupModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // 전체 동의 체크박스 기능
        document.getElementById('terms-all').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.terms-item input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });

        // 관리자 페이지로 이동
        function validateLogin() {
            const id = document.getElementById('username').value.trim();
            const pw = document.getElementById('password').value.trim();

            if (id === 'admin' && pw === 'admin') {
                window.location.href = '../admin/dashboard_main.php';
                return false;
            } else {
                alert('아이디 또는 비밀번호가 잘못되었습니다.');
            }

        return false;
        }       

        
    </script>
</body>
</html>
