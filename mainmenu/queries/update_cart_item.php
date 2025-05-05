<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $cart_item_id = $_POST['cart_item_id'] ?? '';
    $quantity = $_POST['quantity'] ?? '';

    $sql = "UPDATE cart_items SET quantity = $quantity WHERE product_id = $cart_item_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(['success' => true, 'result' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => '장바구니 업데이트 실패']);
    }

    mysqli_close($conn);
?>