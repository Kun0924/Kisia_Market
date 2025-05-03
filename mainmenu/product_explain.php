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
            <h2>리뷰 페이지입니다 <a href="#" class="write-review-btn" onclick="toggleReviewForm(); return false;">글쓰기</a></h2>
            
            <div id="reviewFormContainer" style="display: none;">
                <form id="writeReviewForm" action="insert_review.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
                    <div class="form-group">
                        <label for="reviewTitle">제목</label>
                        <input type="text" id="reviewTitle" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="reviewRating">평점</label>
                        <select id="reviewRating" name="rating" required>
                            <option value="5">★★★★★</option>
                            <option value="4">★★★★☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="1">★☆☆☆☆</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reviewContent">내용</label>
                        <textarea id="reviewContent" name="content" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reviewImage">파일 첨부</label>
                        <input type="file" id="reviewImage" name="review_image">
                        <p class="file-info">* 파일을 첨부할 수 있습니다</p>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="submit-btn">작성하기</button>
                        <button type="button" class="cancel-btn" onclick="toggleReviewForm()">취소</button>
                    </div>
                </form>
            </div>

            <div class="reviews-list">
                <div class="review-item">
                    <div class="review-header">
                        <span class="review-author">김**</span>
                        <span class="review-date">2024-05-01</span>
                        <span class="review-rating">★★★★★</span>
                    </div>
                    <h3 class="review-title">정말 만족스러운 구매입니다</h3>
                    <p class="review-content">품질이 정말 좋네요. 사용감도 좋고 디자인도 깔끔합니다. 다음에도 구매할 의향 있습니다.</p>
                </div>

                <div class="review-item">
                    <div class="review-header">
                        <span class="review-author">이**</span>
                        <span class="review-date">2024-04-28</span>
                        <span class="review-rating">★★★★☆</span>
                    </div>
                    <h3 class="review-title">가격 대비 훌륭한 제품</h3>
                    <p class="review-content">가격이 저렴한데 품질이 생각보다 좋네요. 배송도 빠르고 포장도 잘 되어있었습니다.</p>
                </div>

                <div class="review-item">
                    <div class="review-header">
                        <span class="review-author">박**</span>
                        <span class="review-date">2024-04-25</span>
                        <span class="review-rating">★★★★★</span>
                    </div>
                    <h3 class="review-title">추천합니다</h3>
                    <p class="review-content">친구 추천으로 구매했는데 정말 좋네요. 사용하기 편하고 디자인도 예쁩니다. 다음에 또 구매할게요!</p>
                </div>
            </div>
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

function toggleReviewForm() {
    const formContainer = document.getElementById('reviewFormContainer');
    
    if (formContainer.style.display === 'none') {
        formContainer.style.display = 'block';
    } else {
        formContainer.style.display = 'none';
    }
}
</script>


</body>
</html>
