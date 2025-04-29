<?php
        require_once '/var/www/html/mainmenu/common/db.php';

        $sort = $_GET['sort'] ?? 'newest';
        $price = $_GET['price'] ?? 'all';
        
        $sql = "SELECT * FROM products WHERE 1=1";
        
        // 가격 조건
        if ($price != 'all') {
            if ($price === '200000-up') {
                $sql .= " AND price >= 200000";
            } else {
                [$min, $max] = explode('-', $price);
                $sql .= " AND price BETWEEN $min AND $max";
            }
        }
        
        // 정렬 조건
        switch ($sort) {
            case 'price-low':
                $sql .= " ORDER BY price ASC";
                break;
            case 'price-high':
                $sql .= " ORDER BY price DESC";
                break;
            case 'popular':
                // $sql .= " ORDER BY rating DESC";
                break;
            default:
                $sql .= " ORDER BY created_at DESC";
        }
        
        $result = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="product-card">';
            echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
            echo '<p class="price">' . number_format($row['price']) . '원</p>';
            echo '</div>';
        }

        mysqli_close($conn); // 연결 종료
        ?>