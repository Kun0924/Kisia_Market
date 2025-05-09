<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>KISIA Shop Admin</title>
    
    <!-- 추가 스타일 -->
    <link rel="stylesheet" href="css/admin.css"> 
</head>
<body>

    <!-- 상단 네비게이션 바 -->
    <div class="topbar">
        <div class="logo">
            <h2><a href="dashboard_main.php">KISIA Shop Admin</a></h2>
        </div>
        <nav class="admin-menu">

            <a href="dashboard_main.php" data-page="dashboard_main.php">
                <i class="fas fa-home"></i>
                <span>대시보드</span>
            </a>

            <a href="members.php" data-page="members.php">
                <i class="fas fa-users"></i>
                <span>회원 관리</span>
            </a>

            <a href="products.php" data-page="products.php">
                <i class="fas fa-cube"></i>
                <span>상품 관리</span>
            </a>

            <a href="orders.php" data-page="orders.php">
                <i class="fas fa-shopping-cart"></i>
                <span>주문 관리</span>
            </a>

            <a href="reviews.php" data-page="reviews.php">
                <i class="fas fa-pencil-alt"></i>
                <span>리뷰 관리</span>
            </a>

            <a href="notices.php" data-page="notices.php">
                <i class="fas fa-bullhorn"></i>
                <span>공지사항</span>
            </a>

            <a href="inquiries.php" data-page="inquiries.php">
                <i class="fas fa-question-circle"></i>
                <span>문의사항</span>
            </a>

            <a href="logout.php" data-page="logout.php">
                <i class="fas fa-sign-out-alt"></i>
                <span>로그아웃</span>
            </a>
        </nav>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const links = document.querySelectorAll(".admin-menu a");
        const current = window.location.pathname.split("/").pop(); // 현재 파일명만 추출

        links.forEach(link => {
            if (link.dataset.page === current) {
                link.classList.add("active");
            }
        });
    });
    </script>

</body>
</html>
