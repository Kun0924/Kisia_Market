<?php
if (!isset($_SESSION['user_id'])) {
    echo '<p class="login-message">리뷰를 작성하려면 <a href="login.php">로그인</a>이 필요합니다.</p>';
    exit;
}
?>
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
    <div class="form-buttons">
        <button type="submit" class="submit-btn">작성하기</button>
        <button type="button" class="cancel-btn" onclick="toggleReviewForm()">취소</button>
    </div>
</form> 