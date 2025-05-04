<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$product_id = $_GET['product_id'] ?? 0;
$user_id = $_SESSION['user_id'];

// 리뷰 작성 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    
    // 이미지 업로드 처리
    $image_path = null;
    if (isset($_FILES['review_image']) && $_FILES['review_image']['error'] === 0) {
        $upload_dir = '../review_images/';
        $file_name = time() . '_' . basename($_FILES['review_image']['name']);
        $target_path = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['review_image']['tmp_name'], $target_path)) {
            $image_path = $file_name;
        }
    }
    
    $sql = "INSERT INTO reviews (product_id, user_id, rating, comment, image_path, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiiss", $product_id, $user_id, $rating, $comment, $image_path);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리뷰 작성</title>
    <link rel="stylesheet" href="../mainmenu/css/review_form.css">
</head>
<body>
    <div class="review-modal" id="reviewModal">
        <div class="review-form-container">
            <span class="close-modal" onclick="closeReviewModal()">&times;</span>
            <h2>리뷰 작성</h2>
            <form id="reviewForm" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="rating">평점</label>
                    <select name="rating" id="rating" required>
                        <option value="5">5점</option>
                        <option value="4">4점</option>
                        <option value="3">3점</option>
                        <option value="2">2점</option>
                        <option value="1">1점</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="comment">리뷰 내용</label>
                    <textarea name="comment" id="comment" rows="5" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="review_image">이미지 첨부</label>
                    <input type="file" name="review_image" id="review_image" accept="image/*">
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="submit-btn">리뷰 작성</button>
                    <button type="button" class="cancel-btn" onclick="closeReviewModal()">취소</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showReviewModal() {
            document.getElementById('reviewModal').style.display = 'block';
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').style.display = 'none';
        }

        // 모달 외부 클릭 시 닫기
        window.onclick = function(event) {
            const modal = document.getElementById('reviewModal');
            if (event.target == modal) {
                closeReviewModal();
            }
        }

        // 폼 제출 처리
        document.getElementById('reviewForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('review_form.php?product_id=<?php echo $product_id; ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    closeReviewModal();
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html> 