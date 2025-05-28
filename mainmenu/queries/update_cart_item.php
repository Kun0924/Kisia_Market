<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $cart_item_id = $_POST['cart_item_id'] ?? '';
    $quantity = $_POST['quantity'] ?? '';

    // 숫자만 받아야 하므로 필터링
    $cart_item_id = filter_var($cart_item_id, FILTER_VALIDATE_INT);
    $quantity = filter_var($quantity, FILTER_VALIDATE_INT);

    if ($cart_item_id === false || $quantity === false || $quantity < 1) {
        echo json_encode(['success' => false, 'message' => '잘못된 입력값입니다.']);
        exit;
    }

    // $sql = "UPDATE cart_items SET quantity = $quantity WHERE product_id = $cart_item_id";
    // $result = mysqli_query($conn, $sql);

    $stmt = mysqli_prepare($conn, "UPDATE cart_items SET quantity = ? WHERE product_id = ?");
    mysqli_stmt_bind_param($stmt, "ii", $quantity, $cart_item_id);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo json_encode(['success' => true, 'result' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => '장바구니 업데이트 실패']);
    }

    mysqli_close($conn);
?>