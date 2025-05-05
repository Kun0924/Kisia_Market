<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_SESSION['id'];
    $cart_items = array();

    $sql = "SELECT ci.*, p.image_url, p.name, p.price, p.deliver_price, p.id FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = $id";
    $get_cart_items = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($get_cart_items)) {
        $cart_items[] = $row;
    }

    $subtotal = 0;
    $shippingTotal = 0;
    $grandTotal = 0;
    
    foreach ($cart_items as $item) {
        $subtotal += $item['price'] * $item['quantity'];
        $shippingTotal += $item['deliver_price'];
        $grandTotal += $item['price'] * $item['quantity'] + $item['deliver_price'];
    }
?>
