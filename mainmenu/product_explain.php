<?php
$menu_path = './';
$current_path = '../';
include 'queries/get_header_session.php';

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KISIA SHOP - 상품상세</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/product_explain.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php include 'common/header.php'; ?>
<?php include 'queries/get_product_detail.php'; ?>

<main class="main-content">
    <div class="container">
        <?php
        if (mysqli_num_rows($get_product_detail) > 0) {
            $row = mysqli_fetch_assoc($get_product_detail);
            echo '<div class="product-detail">';
            echo '<div class="product-image">';
            echo '<img src="../' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
            echo '</div>';
            echo '<div class="product-info">';
            echo '<h1>' . htmlspecialchars($row['name']) . '</h1>';
            echo '<p class="price">' . number_format($row['price']) . '원</p>';
            echo '<div class="button-group">';
            echo '<button class="cart-btn"><i class="fas fa-shopping-cart"></i> 장바구니</button>';
            echo '<button class="buy-btn">구매하기</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';


        } else {
            echo '<p>상품을 찾을 수 없습니다.</p>';
        }
        ?>

         
        <div class="tabs">
            <button class="tab-btn active" data-tab="description">상품 설명</button>
            <button class="tab-btn" data-tab="reviews">리뷰</button>
        </div>


        <div id="description" class="tab-content active">
            <?php
            if (!empty($row)) {
                echo '<h2>상품 설명</h2>';
                echo '<p>' . htmlspecialchars($row['description']) . '</p>';
            } else {
                echo '<p>상품 정보가 없습니다.</p>';
            }
            ?>
        </div>

        <div id="reviews" class="tab-content">
            <h2>리뷰 페이지입니다</h2>
            <p>여기는 리뷰 페이지입니다.</p>
        </div>

    </div>
</main>

<?php include 'common/footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // 모든 탭 비활성화
            tabButtons.forEach(btn => btn.classList.remove('active'));
            contents.forEach(content => content.classList.remove('active'));

            // 클릭된 탭만 활성화
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
            button.classList.add('active');
        });
    });
});
</script>


</body>
</html>
