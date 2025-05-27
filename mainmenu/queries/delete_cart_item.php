<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_POST['id'];
    $cart_item_id = $_POST['cart_item_id'];

    // 정수형으로 강제 형변환 (보안 보강)
    // $id = intval($id);
    // $cart_item_id = intval($cart_item_id);

    // $sql = "DELETE FROM cart_items WHERE product_id = $cart_item_id AND user_id = $id";
    // $delete_cart_item = mysqli_query($conn, $sql);

    // Prepared Statement 사용
    $stmt = $conn->prepare("DELETE FROM cart_items WHERE product_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_item_id, $id); // i: integer

    $delete_cart_item = $stmt->execute();

    if ($delete_cart_item) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    mysqli_close($conn);
?>
