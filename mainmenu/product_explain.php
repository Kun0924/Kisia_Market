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
            echo '<p class="short-description">' . htmlspecialchars($row['short_description']) . '</p>';
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
                // echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                echo '<img src="/' . htmlspecialchars($row['description']) . '" alt="상세 이미지">';
            } else {
                echo '<p>상품 정보가 없습니다.</p>';
            }
            ?>
        </div>

        <div id="reviews" class="tab-content">
            <h2>리뷰</h2>

             <?php include 'review_form.php'; // 리뷰 작성 폼 ?>
        </div>

    </div>
</main>

<?php include 'common/footer.php'; ?>

<script>
window.addEventListener('load', function() {
    const tabButtons = document.querySelectorAll('.tab-btn');
    const contents = document.querySelectorAll('.tab-content');

    function switchTab(tabId) {
        // 모든 탭 비활성화
        tabButtons.forEach(btn => {
            btn.classList.remove('active');
        });
        contents.forEach(content => {
            content.classList.remove('active');
        });

        // 선택된 탭 활성화
        const selectedTab = document.querySelector(`.tab-btn[data-tab="${tabId}"]`);
        const selectedContent = document.getElementById(tabId);
        
        if (selectedTab && selectedContent) {
            selectedTab.classList.add('active');
            selectedContent.classList.add('active');
        }
    }

    // 탭 버튼 클릭 이벤트
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            switchTab(tabId);
        });
    });

    // 초기 탭 설정
    const initialTab = document.querySelector('.tab-btn.active');
    if (initialTab) {
        const initialTabId = initialTab.getAttribute('data-tab');
        switchTab(initialTabId);
    }
});
</script>


</body>
</html>
