<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KISIA SHOP - 전체상품</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_all_products.php';?>

    <main class="main-content">
        <div class="container">
            <div class="category-header">
                <h1>전체상품</h1>
            </div>
            
            <div class="filter-section">
                <div class="filter-group">
                    <label>정렬</label>
                    <select id="sort">
                        <option value="newest" selected>최신순</option>
                        <option value="price-low">가격 낮은순</option>
                        <option value="price-high">가격 높은순</option>
                        <option value="popular">평점 높은순</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>가격대</label>
                    <select id="price_range">
                        <option value="all" selected>전체</option>
                        <option value="0-50000">5만원 이하</option>
                        <option value="50000-100000">5만원-10만원</option>
                        <option value="100000-150000">10만원-15만원</option>
                        <option value="150000-200000">15만원-20만원</option>
                        <option value="200000-up">20만원 이상</option>
                    </select>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                const sortSelect = document.getElementById('sort');
                const priceSelect = document.getElementById('price_range');

                function fetchFilteredProducts() {
                    const sort = sortSelect.value;
                    const price = priceSelect.value;

                    fetch(`queries/filter_products.php?sort=${sort}&price=${price}`)
                        .then(response => response.text())
                        .then(data => {
                            document.querySelector('.product-grid').innerHTML = data;
                        })
                        .catch(error => {
                            console.error('AJAX 오류:', error);
                        });
                }

                sortSelect.addEventListener('change', fetchFilteredProducts);
                priceSelect.addEventListener('change', fetchFilteredProducts);
            });
            </script>

            <div class="content-section">
                <div class="product-grid">
                    <?php
                    if (mysqli_num_rows($get_all_products) > 0) {
                        while ($row = mysqli_fetch_assoc($get_all_products)) {
                            // 상품 하나당 하나의 카드 출력
                            echo '<div class="product-card">';
                            echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                            echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                            echo '<p class="price">' . number_format($row['price']) . '원</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>등록된 상품이 없습니다.</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="pagination" id="pagination">
                <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        $active = $i == $page ? 'active' : '';
                        echo "<a href='?page=$i' class='$active'>$i</a>";
                    }
                    if ($page < $total_pages) {
                        $next_page = $page + 1;
                        echo "<a href='?page=$next_page' class='next'>다음 <i class='fas fa-chevron-right'></i></a>";
                    }
                ?>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 