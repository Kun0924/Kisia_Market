<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $type = $_GET['type'];
    $id = $_SESSION['id'];

    if ($type == 'cart') {
        $cart_items = array();

        // $sql = "SELECT ci.*, p.image_url, p.name, p.price, p.deliver_price, p.id FROM cart_items ci JOIN products p ON ci.product_id = p.id WHERE ci.user_id = $id";
        // $get_cart_items = mysqli_query($conn, $sql);

        $sql = "SELECT ci.*, p.image_url, p.name, p.price, p.deliver_price, p.id 
            FROM cart_items ci 
            JOIN products p ON ci.product_id = p.id 
            WHERE ci.user_id = ?";
    
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $cart_items[] = $row;
        }

        mysqli_stmt_close($stmt);

        $subtotal = 0;
        $shippingTotal = 0;
        $grandTotal = 0;
        
        foreach ($cart_items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $shippingTotal += $item['deliver_price'];
            $grandTotal += $item['price'] * $item['quantity'] + $item['deliver_price'];
        }
    } else if ($type == 'direct') {
        $product_id = $_GET['id'];

        // $sql = "SELECT * FROM products WHERE id = $product_id";
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $product_id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);

        $subtotal = $product['price'];
        $shippingTotal = $product['deliver_price'];
        $grandTotal = $product['price'] + $product['deliver_price'];
    }
?>
