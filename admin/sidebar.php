<!-- 사이드바 -->
<div class="sidebar">
    <div class="logo">
        <h2>KISIA Shop Admin</h2>
    </div>
    <nav class="admin-menu">
        <ul>
            <li <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard_main.php' ? 'class="active"' : ''; ?>>
                <a href="dashboard_main.php">
                    <i class="fas fa-home"></i>
                    <span>대시보드</span>
                </a>
            </li>
            <li <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'class="active"' : ''; ?>>
                <a href="products.php">
                    <i class="fas fa-box"></i>
                    <span>상품 관리</span>
                </a>
            </li>
            <li <?php echo basename($_SERVER['PHP_SELF']) == 'members.php' ? 'class="active"' : ''; ?>>
                <a href="members.php">
                    <i class="fas fa-users"></i>
                    <span>회원 관리</span>
                </a>
            </li>
            <li <?php echo basename($_SERVER['PHP_SELF']) == 'board.php' ? 'class="active"' : ''; ?>>
                <a href="board.php">
                    <i class="fas fa-clipboard-list"></i>
                    <span>게시판 관리</span>
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