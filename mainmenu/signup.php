<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="signup-container">
                <h2 class="page-title">회원가입</h2>
                <form class="signup-form">
                    <div class="form-group">
                        <label for="username">아이디</label>
                        <input type="text" id="username" name="username" placeholder="아이디를 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="name">이름</label>
                        <input type="text" id="name" name="name" placeholder="이름을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="email">이메일</label>
                        <input type="email" id="email" name="email" placeholder="이메일을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">휴대폰 번호</label>
                        <input type="tel" id="phone" name="phone" placeholder="휴대폰 번호를 입력하세요" required>
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
    </main>

</body>
</html> 