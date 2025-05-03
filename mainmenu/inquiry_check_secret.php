<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀글 확인 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/check_secret_inquiry.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <!-- Main Content -->
    <main class="secret-check-content">
        <div class="secret-check-container">
            <i class="fas fa-lock lock-icon"></i>
            <h2 class="secret-check-title">비밀글 확인</h2>
            <p class="secret-check-description">
                이 글은 비밀글입니다. <br>
                글을 확인하시려면 비밀번호를 입력하세요.
            </p>
            <form action="queries/verify_secret_inquiry.php" method="POST" class="secret-check-form">
                <input type="hidden" name="inquiry_id" value="<?php echo $_GET['id'] ?? ''; ?>">
                <input type="password" 
                       name="secret_password" 
                       class="secret-check-input" 
                       placeholder="비밀번호를 입력하세요" 
                       required>
                <div class="secret-check-buttons">
                    <button type="submit" class="btn-check btn-submit">확인</button>
                    <a href="inquiry_list.php" class="btn-check btn-cancel">취소</a>
                </div>
            </form>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html>