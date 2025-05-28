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
    $order_status = 'pending';
    
    $product_id = $_POST['product_id'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $price = $_POST['price'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $product_image_url = $_POST['product_image_url'] ?? '';
    $deliver_price = $_POST['deliver_price'] ?? '';

    $type = $_POST['type'] ?? '';
    $all_success = true;
    $fail_message = '주문에 실패했습니다.';

    $stmt = mysqli_prepare($conn, "SELECT point FROM users WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($payment_method == 'point') {
        $order_status = 'paid';
        if ($user['point'] < $order_amount) {
            $all_success = false;
            $fail_message = '포인트가 부족합니다.';
        } else {
            $stmt = mysqli_prepare($conn, "UPDATE users SET point = point - ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, "ds", $order_amount, $userId);
            $result = mysqli_stmt_execute($stmt);
        }
    }

    if ($all_success) {
        $stmt = mysqli_prepare($conn, "INSERT INTO orders (
            user_id, user_name, order_amount, payment_method, depositor_name, bank_name,
            receiver_name, receiver_phone, receiver_email, receiver_address, receiver_postcode,
            receiver_address_detail, delivery_memo, order_status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        mysqli_stmt_bind_param($stmt, "ssssssssssssss",
            $userId, $name, $order_amount, $payment_method, $depositor_name, $bank_name,
            $receiver_name, $receiver_phone, $receiver_email, $receiver_address, $receiver_postcode,
            $receiver_address_detail, $delivery_memo, $order_status
        );

        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            $all_success = false;
        }
    }

    $order_id = mysqli_insert_id($conn);

    if ($type == 'cart') {
        if ($all_success) {
            foreach ($product_id as $key => $value) {
                $stmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_id, product_name, product_image_url, quantity, price, deliver_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
                mysqli_stmt_bind_param(
                    $stmt,
                    "iissidd",
                    $order_id,
                    $product_id[$key],
                    $product_name[$key],
                    $product_image_url[$key],
                    $quantity[$key],
                    $price[$key],
                    $deliver_price[$key]
                );
                $result = mysqli_stmt_execute($stmt);
                if (!$result) {
                    $all_success = false;
                }
            }
        }
    } else if ($type == 'direct') {
        if ($all_success) {
            $stmt = mysqli_prepare($conn, "INSERT INTO order_items (order_id, product_id, product_name, product_image_url, quantity, price, deliver_price) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "iissidd", $order_id, $product_id, $product_name, $product_image_url, $quantity, $price, $deliver_price);
            $result = mysqli_stmt_execute($stmt);
            if (!$result) {
                $all_success = false;
            }
        }
    }

    if ($all_success) {
        $stmt = mysqli_prepare($conn, "DELETE FROM cart_items WHERE user_id = ?");
        mysqli_stmt_bind_param($stmt, "s", $userId);
        $result = mysqli_stmt_execute($stmt);
        if (!$result) {
            $all_success = false;
        }
    }

    if ($all_success) {
        echo "<script>
            alert('주문이 완료되었습니다.');
            window.location.href = '/mainmenu/order-complete.php';
        </script>";
    } else {
        echo "<script>
            alert('$fail_message');
            history.back();
        </script>";
    }
?>
