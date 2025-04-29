<?php
        require_once '/var/www/html/mainmenu/common/db.php';

        // 현재 페이지 번호를 URL에서 가져오고, 없으면 1페이지
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $items_per_page = 6; // 한 페이지에 보여줄 상품 수
        
        $offset = ($page - 1) * $items_per_page;
        
        $sql = "SELECT * FROM products where category = '키보드' ORDER BY id DESC LIMIT $offset, $items_per_page";
        $get_keyboard_products = mysqli_query($conn, $sql);

        $result_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM products where category = '키보드'");
        $total_row = mysqli_fetch_assoc($result_count);
        $total_items = (int)$total_row['total'];
        $total_pages = ceil($total_items / $items_per_page);

        mysqli_close($conn); // 연결 종료
        ?>