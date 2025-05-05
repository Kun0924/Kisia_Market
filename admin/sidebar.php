<!-- 사이드바 -->
<div class="sidebar">
    <div class="logo">
        <h2>KISIA Shop Admin</h2>
    </div>
    <nav class="admin-menu">
        <ul>
            <li <?php echo $_SERVER['PHP_SELF'] == 'dashboard_main.php' ? 'class="active"' : ''; ?>>
                <a href="dashboard_main.php">
                    <i class="fas fa-home"></i>
                    <span>대시보드</span>
                </a>
            </li>
            <li <?php echo $_SERVER['PHP_SELF'] == 'members.php' ? 'class="active"' : ''; ?>>
                <a href="members.php">
                    <i class="fas fa-users"></i>
                    <span>회원 관리</span>
                </a>
            </li>
            <li <?php echo $_SERVER['PHP_SELF'] == 'products.php' ? 'class="active"' : ''; ?>>
                <a href="products.php">
                    <i class="fas fa-cube"></i>
                    <span>상품 관리</span>
                </a>
            </li>
            <li <?php echo basename($_SERVER['PHP_SELF']) == 'approve.php' ? 'class="active"' : ''; ?>>
                <a href="approve.php">
                    <i class="fas fa-shopping-cart"></i>
                    <span>주문 관리</span>
                </a>
            </li>
            <li <?php echo $_SERVER['PHP_SELF'] == 'reviews.php' ? 'class="active"' : ''; ?>>
                <a href="reviews.php">
                    <i class="fas fa-pencil"></i>
                    <span>리뷰 관리</span>
                </a>
            </li>
            <li <?php echo $_SERVER['PHP_SELF'] == 'notices.php' ? 'class="active"' : ''; ?>>
                <a href="notices.php">
                    <i class="fas fa-bullhorn"></i>
                    <span>공지사항 관리</span>
                </a>
            </li>
            <li <?php echo $_SERVER['PHP_SELF'] == 'inquiries.php' ? 'class="active"' : ''; ?>>
                <a href="inquiries.php">
                    <i class="fas fa-question-circle"></i>
                    <span>문의사항 관리</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>로그아웃</span>
                </a>
            </li>
        </ul>
    </nav>
</div> 