<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>계정 찾기 결과 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/find_result.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php include 'queries/get_user_id_pw.php'; ?>

    <main class="main-content">
        <div class="result-container">
            <h2 class="result-title">
                <?php echo $find_type === 'find_id' ? '아이디 찾기 결과' : '비밀번호 찾기 결과'; ?>
            </h2>
            
            <div class="result-box">
                <?php if ($find_type === 'find_id'): ?>
                    <?php if ($user): ?>
                        <p class="result-message">회원님의 아이디는 다음과 같습니다.</p>
                        <p class="result-value"><?php echo $user['userId']; ?></p>
                    <?php else: ?>
                        <p class="result-message">일치하는 회원 정보를 찾을 수 없습니다.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if ($user): ?>
                        <p class="result-message">회원님의 비밀번호는 다음과 같습니다.</p>
                        <p class="result-value"><?php echo $user['password']; ?></p>
                    <?php else: ?>
                        <p class="result-message">일치하는 회원 정보를 찾을 수 없습니다.</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <div class="btn-group">
                <a href="login.php" class="btn">로그인하기</a>
                <a href="find_id.php" class="btn btn-secondary">다시 찾기</a>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 