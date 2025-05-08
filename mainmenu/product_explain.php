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
            echo '<img src="/' . $row['image_url'] . '" alt="' . $row['name'] . '">';
            echo '</div>';
            echo '<div class="product-info">';
            echo '<h1>' . $row['name'] . '</h1>';
            echo '<p class="short-description">' . $row['short_description'] . '</p>';
            
            // 평균 평점 표시 수정
            $avg_rating = isset($row['avg_rating']) ? number_format($row['avg_rating'], 1) : 0;
            echo '<div class="product-rating">';
            echo '<div class="star-rating">' . str_repeat('★', floor($avg_rating)) . str_repeat('☆', 5 - floor($avg_rating)) . '</div>';
            echo '<span class="rating-number">' . $avg_rating . '</span>';
            echo '</div>';
            
            echo '<p class="price">' . number_format($row['price']) . '원</p>';
            echo '<div class="button-group">';
            echo '<button class="cart-btn" id="addToCartBtn"><i class="fas fa-shopping-cart"></i> 장바구니</button>';
            echo '<button class="buy-btn" id="buyBtn">구매하기</button>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<p>상품을 찾을 수 없습니다.</p>';
        }
        ?>

         
        <div class="tabs">
            <button class="tab-btn active" data-tab="description">상품 설명</button>
            <button class="tab-btn" data-tab="reviews">리뷰 (<?php echo $row['review_count']; ?>)</button>
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
                    echo '<a href="#" class="write-review-btn" onclick="toggleReviewForm(); return false;">글쓰기</a>';
                    }
                ?>
            </h2>
            
            <!-- 리뷰 작성 -->
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
                        echo '<div class="review-item" id="review-' . $reviews['id'] . '">';
                        // 일반 리뷰 보기 영역
                        echo '<div class="review-view">';
                        echo '<div class="review-header">';
                            echo '<span class="review-author">' . $reviews['name'] . '</span>';
                            echo '<span class="review-date">' . $reviews['created_at'] . '</span>';
                            echo '<span class="review-rating">' . str_repeat('★', $reviews['rating']) . str_repeat('☆', 5 - $review['rating']) . '</span>';
                            
                            if (isset($_SESSION['id']) && $_SESSION['id'] == $reviews['user_id']) {
                                echo '<div class="review-actions">';
                                echo '<button class="edit-btn" onclick="toggleReviewEdit(' . $reviews['id'] . ')">수정</button>';
                                echo '<button class="delete-btn" onclick="if(confirm(\'정말로 삭제하시겠습니까?\')) deleteReview(' . $reviews['id'] . ')">삭제</button>';
                                echo '</div>';
                            }
                        echo '</div>';
                        if ($reviews['image_url']) {
                            echo '<div class="review-image">';
                                echo '<a href="/' . $reviews['image_url'] . '" target="_blank"><img src="../' . $reviews['image_url'] . '" alt="리뷰 이미지"></a>';
                            echo '</div>';
                        }
                        echo '<p class="review-content">' . $reviews['content'] . '</p>';
                        echo '</div>';

                        // 리뷰 수정 폼 영역
                        echo '<div class="review-edit" style="display: none;">';
                        echo '<form class="edit-review-form" onsubmit="updateReview(event, ' . $reviews['id'] . ')">';
                        echo '<input type="hidden" name="image_url" value="' . $review['image_url'] . '">';
                        echo '<div class="form-group">';
                        echo '<label for="editRating-' . $reviews['id'] . '">평점</label>';
                        echo '<select id="editRating-' . $reviews['id'] . '" name="rating" required>';
                        for ($i = 5; $i >= 1; $i--) {
                            $selected = ($i == $reviews['rating']) ? 'selected' : '';
                            echo '<option value="' . $i . '" ' . $selected . '>' . str_repeat('★', $i) . str_repeat('☆', 5-$i) . '</option>';
                        }
                        echo '</select>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        echo '<label for="editContent-' . $reviews['id'] . '">내용</label>';
                        echo '<textarea id="editContent-' . $reviesw['id'] . '" name="content" rows="5" required>' . $reviews['content'] . '</textarea>';
                        echo '</div>';
                        echo '<div class="form-group">';
                        if ($reviews['image_url']) {
                            echo '<div class="current-image">';
                            echo '<p>현재 이미지:</p>';
                            echo '<img src="../' . $reviews['image_url'] . '" alt="현재 이미지" style="max-width: 200px;">';
                            echo '<label><input type="checkbox" name="delete_image" id="deleteImage-' . $reviews['id'] . '"> 이미지 삭제</label>';
                            echo '</div>';
                        }
                        echo '<label for="editImage-' . $reviews['id'] . '">파일 첨부</label>';
                        echo '<input type="file" id="editImage-' . $reviews['id'] . '" name="file">';
                        echo '<p class="file-info">* 파일을 첨부할 수 있습니다</p>';
                        echo '</div>';
                        echo '<div class="form-buttons">';
                        echo '<button type="submit" class="submit-btn">수정하기</button>';
                        echo '<button type="button" class="cancel-btn" onclick="toggleReviewEdit(' . $reviews['id'] . ')">취소</button>';
                        echo '</div>';
                        echo '</form>';
                        echo '</div>';
                        
                        echo '</div>';
                    }
                } else {
                    echo '<p>리뷰가 없습니다.</p>';
                }
                ?>  
            </div>

            <!-- 리뷰 수정 폼 -->
            <div id="editReviewFormContainer" style="display: none;">
                <form id="editReviewForm" action="queries/update_review.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="review_id" id="editReviewId">
                    <input type="hidden" name="product_id" value="<?php echo $_GET['id']; ?>">
                    <div class="form-group">
                        <label for="editReviewRating">평점</label>
                        <select id="editReviewRating" name="rating" required>
                            <option value="5">★★★★★</option>
                            <option value="4">★★★★☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="1">★☆☆☆☆</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editReviewContent">내용</label>
                        <textarea id="editReviewContent" name="content" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <div id="currentImageContainer" style="display: none;">
                            <p>현재 이미지:</p>
                            <img id="currentImage" src="" alt="현재 이미지" style="max-width: 200px;">
                            <label>
                                <input type="checkbox" name="delete_image" id="deleteImage"> 이미지 삭제
                            </label>
                        </div>
                        <label for="editReviewImage">새 파일 첨부</label>
                        <input type="file" id="editReviewImage" name="file">
                        <p class="file-info">* 파일을 첨부할 수 있습니다</p>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="submit-btn">수정하기</button>
                        <button type="button" class="cancel-btn" onclick="toggleEditReview()">취소</button>
                    </div>
                </form>
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
    const id = '<?php if (isset($_SESSION['id'])) { echo $_SESSION['id']; } else { echo ''; } ?>';

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
        if (id) {
            const id = '<?php if (isset($_SESSION['id'])) { echo $_SESSION['id']; } else { echo ''; } ?>';
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
        } else {
            alert('로그인 후 이용해주세요.');
            window.location.href = 'login.php';
        }
    });

    // 구매하기 버튼: 구매 페이지로 이동
    document.getElementById('buyBtn').addEventListener('click', function () {
        if (id) {
            window.location.href = 'checkout.php?type=direct&id=' + '<?php if (isset($_GET['id'])) { echo $_GET['id']; } else { echo ''; } ?>';
        } else {
            alert('로그인 후 이용해주세요.');
            window.location.href = 'login.php';
        }
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

// 리뷰 작성 함수
function toggleReviewForm() {
    const formContainer = document.getElementById('reviewFormContainer');
    const editFormContainer = document.getElementById('editReviewFormContainer');

    // 작성 폼 열기 → 수정 폼 닫기
    if (formContainer.style.display === 'none' || formContainer.style.display === '') {
        formContainer.style.display = 'block';
        editFormContainer.style.display = 'none';
    } else {
        formContainer.style.display = 'none';
    }
}

// 리뷰 수정 함수
function toggleReviewEdit(reviewId) {
    const reviewItem = document.getElementById(`review-${reviewId}`);
    const viewArea = reviewItem.querySelector('.review-view');
    const editArea = reviewItem.querySelector('.review-edit');
    
    if (editArea.style.display === 'none') {
        viewArea.style.display = 'none';
        editArea.style.display = 'block';
    } else {
        viewArea.style.display = 'block';
        editArea.style.display = 'none';
    }
}

// 리뷰 삭제 함수
function deleteReview(reviewId) {
    fetch('queries/delete_review.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'review_id=' + reviewId + '&product_id=<?php echo $_GET['id']; ?>'
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('리뷰가 삭제되었습니다.');
            location.reload();
        } else {
            alert('리뷰 삭제에 실패했습니다.');
        }
    });
}

// 리뷰 수정 함수
function updateReview(event, reviewId) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    formData.append('review_id', reviewId);
    formData.append('product_id', '<?php echo $_GET['id']; ?>');
    formData.append('image_url', '<?php echo $row['image_url']; ?>');

    // 이미지 삭제 체크박스 상태 추가
    const deleteImageCheckbox = document.getElementById(`deleteImage-${reviewId}`);
    if (deleteImageCheckbox && deleteImageCheckbox.checked) {
        formData.append('delete_image', '1');
    }

    fetch('queries/update_review.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('리뷰가 수정되었습니다.');
            location.reload();
        } else {
            alert('리뷰 수정에 실패했습니다.');
        }
    });
}

</script>


</body>
</html>
