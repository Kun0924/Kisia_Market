<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_POST['id'] ?? '';
    $product_id = $_POST['product_id'] ?? '';

    $sql = "SELECT * FROM cart_items WHERE user_id = '$id' AND product_id = '$product_id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => '이미 장바구니에 추가된 상품입니다.']);
    } else {
        $sql = "INSERT INTO cart_items (user_id, product_id) VALUES ('$id', '$product_id')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => '장바구니 추가 실패']);
        }
    }

    mysqli_close($conn);
?>