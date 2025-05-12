<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
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
                <form class="login-form" method="POST" action="queries/login_process.php">
                    <div class="form-group">
                        <label for="username">아이디</label>
                        <input type="text" id="username" name="username" placeholder="아이디를 입력하세요" >
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요" >
                    </div>
                    <div class="form-options">
                        <div class="remember-me">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">아이디 저장</label>
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

    <script>
        // 관리자 페이지로 이동
        // function validateLogin() {
        //     const id = document.getElementById('username').value.trim();
        //     const pw = document.getElementById('password').value.trim();

        //     if (id === 'admin' && pw === 'admin') {
        //         window.location.href = '../admin/dashboard_main.php';
        //         return false;
        //     } else {
        //         alert('아이디 또는 비밀번호가 잘못되었습니다.');
        //     }

        // return false;
        // }       
    </script>
</body>
</html>
