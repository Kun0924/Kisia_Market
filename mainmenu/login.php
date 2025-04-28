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
                <form class="login-form" method="POST" action="login_process.php">
                    <div class="form-group">
                        <label for="username">아이디</label>
                        <input type="text" id="username" name="username" placeholder="아이디를 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요" required>
                    </div>
                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <span>아이디 저장</span>
                        </label>
                        <div class="find-links">
                            <a href="find-id.php">아이디 찾기</a>
                            <span class="divider">|</span>
                            <a href="find-password.php">비밀번호 찾기</a>
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

</body>
</html>
