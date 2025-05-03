<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_POST['id'];
    $cart_item_id = $_POST['cart_item_id'];
    error_log("!!!!!!!!!!!!!!!!!!!!!!!!!!cart_item_id: " . $id);

    $sql = "DELETE FROM cart_items WHERE id = $cart_item_id AND user_id = $id";
    $delete_cart_item = mysqli_query($conn, $sql);

    if ($delete_cart_item) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    mysqli_close($conn);
?>
