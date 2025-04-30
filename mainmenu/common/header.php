<!DOCTYPE html>
<html lang="ko">    <!-- Header -->
    <header class="header">
        <div class="header-top">
            <div class="container">
                <div class="header-links">
                    <a href="../mainmenu/login.php" class="header-link">로그인/회원가입</a>
                    <a href="../mainmenu/cart.php" class="header-link">장바구니</a>
                    <a href="../mainmenu/mypage.php" class="header-link">마이페이지</a>
                    <a href="../mainmenu/customer-service.php" class="header-link">고객센터</a>
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
                <!-- <div class="search-box">
                    <input type="text" placeholder="검색어를 입력하세요" name="search_query">
                    <button><i class="fas fa-search"></i></button>
                </div> -->
            </div>
        </div>
    </header>

    <!-- Main Menu -->
    <nav class="main-menu">
        <div class="container">
            <ul class="menu-list">
                <li><a href="../mainmenu/all.php?page=1&sort=newest&price_range=all">전체상품</a></li>
                <li><a href="../mainmenu/keyboard.php?page=1&sort=newest&price_range=all">키보드</a></li>
                <li><a href="../mainmenu/mouse.php?page=1&sort=newest&price_range=all">마우스</a></li>
                <li><a href="../mainmenu/mousepad.php?page=1&sort=newest&price_range=all">마우스 패드</a></li>
                <li><a href="../mainmenu/accessory.php?page=1&sort=newest&price_range=all">악세서리</a></li>
            </ul>
        </div>
    </nav>
</html> 