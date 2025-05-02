<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KISIA SHOP - 마우스 패드</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_keyboard_products.php';?>

    <main class="main-content">
        <div class="container">
            <div class="category-header">
                <h1>키보드</h1>
            </div>
            
            <div class="filter-section">
                <div class="filter-group">
                    <label>정렬</label>
                    <select id="sort">
                    <option value="newest" <?= $sort == 'newest' ? 'selected' : '' ?>>최신순</option>
                    <option value="price-low" <?= $sort == 'price-low' ? 'selected' : '' ?>>가격 낮은순</option>
                    <option value="price-high" <?= $sort == 'price-high' ? 'selected' : '' ?>>가격 높은순</option>
                    <option value="popular" <?= $sort == 'popular' ? 'selected' : '' ?>>평점 높은순</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>가격대</label>
                    <select id="price_range">
                    <option value="all" <?= $price_range == 'all' ? 'selected' : '' ?>>전체</option>
                    <option value="0-50000" <?= $price_range == '0-50000' ? 'selected' : '' ?>>5만원 이하</option>
                    <option value="50000-100000" <?= $price_range == '50000-100000' ? 'selected' : '' ?>>5만원-10만원</option>
                    <option value="100000-150000" <?= $price_range == '100000-150000' ? 'selected' : '' ?>>10만원-15만원</option>
                    <option value="150000-200000" <?= $price_range == '150000-200000' ? 'selected' : '' ?>>15만원-20만원</option>
                    <option value="200000-up" <?= $price_range == '200000-up' ? 'selected' : '' ?>>20만원 이상</option>
                    </select>
                </div>
            </div>

            <script>
                document.getElementById('sort').addEventListener('change', updateFilters);
                document.getElementById('price_range').addEventListener('change', updateFilters);
                
                function updateFilters() {
                    const sort = document.getElementById('sort').value;
                    const price_range = document.getElementById('price_range').value;
                    window.location.href = `?page=1&sort=${sort}&price_range=${price_range}`;
                }
            </script>

            <div class="content-section">
                <div class="product-grid">
                    <?php
                    if (mysqli_num_rows($get_keyboard_products) > 0) {
                        while ($row = mysqli_fetch_assoc($get_keyboard_products)) {
                            // 상품 하나당 하나의 카드 출력
                            echo '<div class="product-card">';
                            echo '<a href="product_explain.php?id=' . $row['id'] . '">';
                            echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                            echo '</a>';
                            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                            echo '<p class="price">' . number_format($row['price']) . '원</p>';
                            echo '</div>';
                        }
                    }
                    ?> 
                </div>
            </div>

            <div class="pagination" id="pagination">
                <?php
                $sort = $_GET['sort'] ?? 'newest';
                $price_range = $_GET['price_range'] ?? 'all';

                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = $i == $page ? 'active' : '';
                    echo "<a href='?page=$i&sort=$sort&price_range=$price_range' class='$active'>$i</a>";
                }
                if ($page < $total_pages) {
                    $next_page = $page + 1;
                    echo "<a href='?page=$next_page&sort=$sort&price_range=$price_range' class='next'>다음 <i class='fas fa-chevron-right'></i></a>";
                }
                ?>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 