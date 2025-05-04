<form action="review_submit.php" method="POST" class="review-form">
    <div class="form-group">
        <label for="reviewer">제목</label>
        <input type="text" id="reviewer" name="reviewer" required>
    </div>

    <div class="form-group">
        <label for="rating">평점</label>
        <select id="rating" name="rating" required>
            <option value="">선택하세요</option>
            <option value="5">★★★★★ (5점)</option>
            <option value="4">★★★★☆ (4점)</option>
            <option value="3">★★★☆☆ (3점)</option>
            <option value="2">★★☆☆☆ (2점)</option>
            <option value="1">★☆☆☆☆ (1점)</option>
        </select>
    </div>

    <div class="form-group">
        <label for="content">리뷰 내용</label>
        <textarea id="content" name="content" rows="4" required></textarea>
    </div>

    <div class="form-buttons">
        <button type="submit" class="submit-btn">리뷰 등록</button>
        <button type="button" class="cancel-btn" id="cancel-review">취소</button>
    </div>
</form>