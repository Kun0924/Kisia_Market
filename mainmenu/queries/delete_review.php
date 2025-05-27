<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $review_id = isset($_POST['review_id']) ? intval($_POST['review_id']) : 0;
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    $success = true;

    // $sql = "DELETE FROM reviews WHERE id = $review_id";
    // $result = mysqli_query($conn, $sql);

    // 1. 리뷰 삭제
    $stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
    $stmt->bind_param("i", $review_id);
    if (!$stmt->execute()) $success = false;
    $stmt->close();    

    // 평점 업데이트
    // $sql = "UPDATE products SET avg_rating = (SELECT AVG(rating) FROM reviews WHERE product_id = '$product_id') WHERE id = '$product_id'";
    // $result = mysqli_query($conn, $sql);
    // 2. 평점 업데이트
    $stmt = $conn->prepare("UPDATE products SET avg_rating = (SELECT AVG(rating) FROM reviews WHERE product_id = ?) WHERE id = ?");
    $stmt->bind_param("ii", $product_id, $product_id);
    if (!$stmt->execute()) $success = false;
    $stmt->close();

    // 리뷰 개수 업데이트
    // $sql = "UPDATE products SET review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = '$product_id') WHERE id = '$product_id'";
    // $result = mysqli_query($conn, $sql);
    // 3. 리뷰 개수 업데이트
    $stmt = $conn->prepare("UPDATE products SET review_count = (SELECT COUNT(*) FROM reviews WHERE product_id = ?) WHERE id = ?");
    $stmt->bind_param("ii", $product_id, $product_id);
    if (!$stmt->execute()) $success = false;
    $stmt->close();

    // 결과 출력
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    mysqli_close($conn);
?>