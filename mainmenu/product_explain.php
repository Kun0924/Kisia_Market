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
            echo '<button class="cart-btn" id="addToCartBtn"><i class="fas fa-shopping-cart"></i> 장바구니</button>';
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
                echo '<img src="/' . $row['description'] . '" alt="상세 이미지">';
            } else {
                echo '<p>상품 정보가 없습니다.</p>';
            }
            ?>
        </div>

        <div id="reviews" class="tab-content">
        <h2>리뷰 페이지
                <?php
                if (isset($_SESSION['userId'])) {
                    echo '<a href="#" class="write-review-btn" onclick="toggleReviewForm(); return false;">글쓰기</a>';}
                ?>
            </h2>
            
            <div id="reviewFormContainer" style="display: none;">
                <form id="writeReviewForm" action="queries/insert_review.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
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
                        <input type="file" id="reviewImage" name="file">
                        <p class="file-info">* 파일을 첨부할 수 있습니다</p>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="submit-btn">작성하기</button>
                        <button type="button" class="cancel-btn" onclick="toggleReviewForm()">취소</button>
                    </div>
                </form>
            </div>

            <div class="reviews-list">
                <?php
                if (mysqli_num_rows($get_reviews) > 0) {
                    while ($review = mysqli_fetch_assoc($get_reviews)) {
                        echo '<div class="review-item">';
                        echo '<div class="review-header">';
                            echo '<span class="review-author">' . $review['name'] . '</span>';
                            echo '<span class="review-date">' . $review['created_at'] . '</span>';
                            echo '<span class="review-rating">' . str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']) . '</span>';
                        echo '</div>';
                        if ($review['image_url']) {
                            echo '<div class="review-image">';
                                echo '<img src="../' . $review['image_url'] . '" alt="리뷰 이미지">';
                            echo '</div>';
                        }
                        echo '<p class="review-content">' . $review['content'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>리뷰가 없습니다.</p>';
                }
                ?>  
            </div>
        </div>

    </div>
    <div id="cartModal" class="modal" style="display:none;">
        <div class="modal-content">
            <p>장바구니에 성공적으로 담겼습니다.</p>
            <div class="modal-buttons">
                <button id="continueShoppingBtn">계속 쇼핑하기</button>
                <button id="goToCartBtn">장바구니 가기</button>
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

    // 장바구니 버튼 클릭 시 모달 표시
    document.getElementById('addToCartBtn').addEventListener('click', function () {
        const id = '<?php echo $_SESSION['id']; ?>';
        const product_id = '<?php echo $_GET['id']; ?>';

        fetch('/mainmenu/queries/insert_cart_item.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}&product_id=${product_id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('cartModal').style.display = 'flex';
            } else {
                alert(data.message);
            }
        });
    });

    // 계속 쇼핑하기 버튼: 모달 닫기
    document.getElementById('continueShoppingBtn').addEventListener('click', function () {
        document.getElementById('cartModal').style.display = 'none';
    });

    // 장바구니 가기 버튼: 장바구니 페이지로 이동
    document.getElementById('goToCartBtn').addEventListener('click', function () {
        window.location.href = 'cart.php';
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
