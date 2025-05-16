<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>로그아웃 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="logout-container">
        <div class="logout-box">
            <i class="fas fa-sign-out-alt logout-icon"></i>
            <h2 class="logout-title">로그아웃</h2>
            <div class="logout-buttons">
                <button class="logout-btn logout-confirm" onclick="location.href='/mainmenu/queries/logout_process.php'">로그아웃
                </button>
                <button class="logout-btn logout-cancel" onclick="location.href='dashboard_main.php'">취소</button>
            </div>
        </div>
    </div>
</body>
</html> 