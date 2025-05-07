<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_POST['user_id'] ?? '';
    $productId = $_POST['product_id'] ?? '';
    $content = $_POST['content'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $imageName = $_FILES['file']['name'] ?? '';

    $imageUrl = '';
    
    // 첨부파일 업로드
    if(!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $uniqueFileName = uniqid() . '_' . $fileName;
        $imageUrl = 'review_images/' . $uniqueFileName;
        move_uploaded_file($tmpName, '/var/www/html/' . $imageUrl);
        if (!move_uploaded_file($tmpName, '/var/www/html/review_images/' . $uniqueFileName)) {
            echo "파일 저장 실패";
            $result = false;
        }
    } else if (!empty($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "파일 업로드 오류: " . $_FILES['file']['error'];
        $result = false;
    }
    

    $sql = "INSERT INTO reviews (user_id, product_id, content, rating, image_url) VALUES ('$userId', '$productId', '$content', '$rating', '$imageUrl')";
    $result = mysqli_query($conn, $sql);

    // 평점 업데이트
    $sql = "UPDATE products SET avg_rating = (SELECT AVG(rating) FROM reviews WHERE product_id = '$productId') WHERE id = '$productId'";
    $result = mysqli_query($conn, $sql);

    // 리뷰 개수 업데이트
    $sql = "UPDATE products SET review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = '$productId') WHERE id = '$productId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
            alert('리뷰가 완료되었습니다.');
            window.location.href = '/mainmenu/product_explain.php?id=$productId';
        </script>";
    } 
    else {
        echo "<script>
            alert('리뷰에 실패했습니다.');
            history.back();
        </script>";
    }

    mysqli_close($conn);
?>