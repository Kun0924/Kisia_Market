<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 찾기 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <main class="main-content">
        <div class="find-container">
            <div class="find-tabs">
                <a href="find_id.php" class="find-tab">아이디 찾기</a>
                <a href="find_password.php" class="find-tab active">비밀번호 찾기</a>
            </div>
            
            <div class="find-form-container">
                <h2 class="page-title">비밀번호 찾기</h2>
                <form class="find-form" action="find_result.php" method="POST">
                    <input type="hidden" name="find_type" value="find_password">
                    <div class="form-group">
                        <label for="user_id">아이디</label>
                        <input type="text" id="user_id" name="user_id" required>
                    </div>
                    <div class="form-group">
                        <label for="name">이름</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">이메일</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">휴대폰 번호</label>
                        <input type="tel" id="phone" name="phone" placeholder="01000000000" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-find">비밀번호 찾기</button>
                    </div>
                </form>
                <div class="find-links">
                    <a href="login.php">로그인으로 돌아가기</a>
                </div>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 