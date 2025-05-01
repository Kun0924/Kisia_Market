<!DOCTYPE html>
<html lang="ko">
    <header class="header">
        <div class="header-top">
            <div class="container">
                <?php if (!isset($menu_path)) $menu_path = './'; ?>
                <div class="header-links">
                    <?php if ($userId): ?>
                        <p class="header-link">안녕하세요 <span style="color: #ff6b6b;"><?= htmlspecialchars($name) ?></span>님</p>
                        <a href="<?= $menu_path ?>queries/logout_process.php" class="header-link">로그아웃</a>
                         <a href="<?= $menu_path ?>cart.php" class="header-link">장바구니</a>
                        <a href="<?= $menu_path ?>mypage.php" class="header-link">마이페이지</a>
                    <?php else: ?>
                        <a href="<?= $menu_path ?>login.php" class="header-link">로그인/회원가입</a>
                    <?php endif; ?>
                    <a href="<?= $menu_path ?>customer-service.php" class="header-link">고객센터</a>
                </div>

            </div>
        </div>
        <div class="header-main">
            <div class="container">
                <div class="logo">
                    <h1><a href="../../index.php">KISIA SHOP</a></h1>
                </div>
                <form action="../mainmenu/search_result.php" method="get" class="search-box">
                    <input type="text" name="search_query" placeholder="검색어 입력">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </header>

    <!-- Main Menu -->
    <?php if (!isset($menu_path)) $menu_path = './'; ?>
    <nav class="main-menu">
        <div class="container">
            <ul class="menu-list">
                <li><a href="<?= $menu_path ?>all.php?page=1&sort=newest&price_range=all">전체상품</a></li>
                <li><a href="<?= $menu_path ?>keyboard.php?page=1&sort=newest&price_range=all">키보드</a></li>
                <li><a href="<?= $menu_path ?>mouse.php?page=1&sort=newest&price_range=all">마우스</a></li>
                <li><a href="<?= $menu_path ?>mousepad.php?page=1&sort=newest&price_range=all">마우스 패드</a></li>
                <li><a href="<?= $menu_path ?>accessory.php?page=1&sort=newest&price_range=all">악세서리</a></li>
            </ul>
        </div>
    </nav>

</html> 