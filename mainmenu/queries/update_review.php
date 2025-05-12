<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $review_id = $_POST['review_id'] ?? '';
    $productId = $_POST['product_id'] ?? '';
    $rating = $_POST['rating'] ?? '';
    $content = $_POST['content'] ?? '';
    $delete_image = isset($_POST['delete_image']) ? $_POST['delete_image'] : '';
    $previous_image = $_POST['previous_image'] ?? '';

    if ($delete_image) {
        $previous_image = '';
    }

    if (!empty($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $uniqueFileName = uniqid() . '_' . $fileName;
        $imageUrl = 'review_images/' . $uniqueFileName;
        move_uploaded_file($tmpName, '/var/www/html/' . $imageUrl);
            
    } else if (!empty($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {
        echo "파일 업로드 오류";
        $result = false;
    } else {
        $imageUrl = $previous_image;
    }

    $sql = "UPDATE reviews SET rating = '$rating', content = '$content', image_url = '$imageUrl' WHERE id = '$review_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $avgSql = "UPDATE products SET avg_rating = (SELECT ROUND(AVG(rating), 1) FROM reviews WHERE product_id = '$productId') WHERE id = '$productId'";
        $countSql = "UPDATE products SET review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = '$productId') WHERE id = '$productId'";
        mysqli_query($conn, $avgSql);
        mysqli_query($conn, $countSql);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    mysqli_close($conn);
?>