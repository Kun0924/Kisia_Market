<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_POST['user_id'] ?? '';
    $productId = $_POST['product_id'] ?? '';
    $content = $_POST['content'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $imageName = $_FILES['file']['name'] ?? '';
    
    // 첨부파일 업로드
    if($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        
        $uniqueFileName = uniqid() . '_' . $fileName;
        move_uploaded_file($tmpName, '/var/www/html/review_images/' . $uniqueFileName);
    } else {
        echo "파일 업로드 오류: " . $_FILES['file']['error'];
        $result = false;
    }
    
    $imageUrl = 'review_images/' . $uniqueFileName;

    $sql = "INSERT INTO reviews (user_id, product_id, content, rating, image_url) VALUES ('$userId', '$productId', '$content', '$rating', '$imageUrl')";
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