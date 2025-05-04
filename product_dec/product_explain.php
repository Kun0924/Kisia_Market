<div class="reviews-section">
    <h3>리뷰</h3>
    <button class="write-review-btn" onclick="showReviewModal()">리뷰 작성</button>
    <?php include 'review_form.php'; ?>
    <div class="reviews-list">
        <?php
        // 기존 리뷰 목록 표시 코드
        ?>
    </div>
</div>

<script>
    function showReviewModal() {
        document.getElementById('reviewModal').style.display = 'block';
    }
</script> 