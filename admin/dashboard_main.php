<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>관리자 페이지 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>

        <!-- 메인 콘텐츠 -->
        <div class="main-content">
            <header class="admin-header">
                <h1>대시보드</h1>
            </header>
            <div class="dashboard-content">
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <h3>총 주문</h3>
                        <p>0</p>
                    </div>
                    <div class="stat-card">
                        <h3>총 회원</h3>
                        <p>0</p>
                    </div>
                    <div class="stat-card">
                        <h3>총 상품</h3>
                        <p>0</p>
                    </div>
                    <div class="stat-card">
                        <h3>총 매출</h3>
                        <p>0원</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 