<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $review_id = $_POST['review_id'];
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM reviews WHERE id = $review_id";
    $result = mysqli_query($conn, $sql);

    // 평점 업데이트
    $sql = "UPDATE products SET avg_rating = (SELECT AVG(rating) FROM reviews WHERE product_id = '$product_id') WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    // 리뷰 개수 업데이트
    $sql = "UPDATE products SET review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = '$product_id') WHERE id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    mysqli_close($conn);
?>