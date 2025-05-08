<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>KISIA Shop Admin</title>

    <!-- 구글 폰트, 아이콘 및 스타일 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
    
    <!-- 추가 스타일 -->
    <link rel="stylesheet" href="css/admin.css"> <!-- 너가 따로 사용하는 스타일 파일 -->
</head>
<body>

    <!-- 상단 네비게이션 바 -->
    <div class="topbar">
        <div class="logo">
            <h2><a href="dashboard_main.php">KISIA Shop Admin</a></h2>
        </div>
        <nav class="admin-menu">

            <a href="dashboard_main.php">
                <i class="fas fa-home"></i>
                <span>대시보드</span>
            </a>

            <a href="members.php">
                <i class="fas fa-users"></i>
                <span>회원 관리</span>
            </a>

            <a href="products.php">
                <i class="fas fa-cube"></i>
                <span>상품 관리</span>
            </a>

            <a href="orders.php">
                <i class="fas fa-shopping-cart"></i>
                <span>주문 관리</span>
            </a>

            <a href="reviews.php">
                <i class="fas fa-pencil-alt"></i>
                <span>리뷰 관리</span>
            </a>

            <a href="notices.php">
                <i class="fas fa-bullhorn"></i>
                <span>공지사항</span>
            </a>

            <a href="inquiries.php">
                <i class="fas fa-question-circle"></i>
                <span>문의사항</span>
            </a>

            <a href="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>로그아웃</span>
            </a>
        </nav>
    </div>

</body>
</html>
