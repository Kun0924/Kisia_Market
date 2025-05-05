<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_POST['user_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $order_amount = $_POST['order_amount'] ?? '';
    $payment_method = $_POST['payment'] ?? '';
    $depositor_name = $_POST['depositor-name'] ?? '';
    $bank_name = $_POST['bank-name'] ?? '';
    $receiver_name = $_POST['receiver_name'] ?? '';
    $receiver_phone = $_POST['receiver_phone'] ?? '';
    $receiver_email = $_POST['receiver_email'] ?? '';
    $receiver_address = $_POST['receiver_address'] ?? '';
    $receiver_postcode = $_POST['receiver_postcode'] ?? '';
    $receiver_address_detail = $_POST['receiver_address_detail'] ?? '';
    $delivery_memo = $_POST['delivery_memo'] ?? '';
    
    $product_id = $_POST['product_id'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $price = $_POST['price'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $product_image_url = $_POST['product_image_url'] ?? '';
    $deliver_price = $_POST['deliver_price'] ?? '';

    $all_success = true;

    $sql = "INSERT INTO orders (user_id, user_name, order_amount, payment_method, depositor_name, bank_name, receiver_name, receiver_phone, receiver_email, receiver_address, receiver_postcode, receiver_address_detail, delivery_memo) VALUES ('$userId', '$name', '$order_amount', '$payment_method', '$depositor_name', '$bank_name', '$receiver_name', '$receiver_phone', '$receiver_email', '$receiver_address', '$receiver_postcode', '$receiver_address_detail', '$delivery_memo')";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        $all_success = false;
    }

    $order_id = mysqli_insert_id($conn);

    foreach ($product_id as $key => $value) {
        $sql = "INSERT INTO order_items (order_id, product_id, product_name, product_image_url, quantity, price, deliver_price) VALUES ('$order_id', '$product_id[$key]', '$product_name[$key]', '$product_image_url[$key]', '$quantity[$key]', '$price[$key]', '$deliver_price[$key]')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $all_success = false;
        }
    }

    // 장바구니 비우기
    $sql = "DELETE FROM cart_items WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        $all_success = false;
    }

    if ($all_success) {
        echo "<script>
            alert('주문이 완료되었습니다.');
            window.location.href = '/mainmenu/order-complete.php';
        </script>";
    } else {
        echo "<script>
            alert('주문에 실패했습니다.');
            history.back();
        </script>";
    }
?>
