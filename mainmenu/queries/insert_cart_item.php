<?php
require_once '/var/www/html/mainmenu/common/db.php';

$id = $_POST['id'] ?? '';
$product_id = $_POST['product_id'] ?? '';

$response = ['success' => false, 'message' => '알 수 없는 오류 발생'];

if ($id !== '' && $product_id !== '') {
    // 1. 이미 존재하는지 확인
    $check_sql = "SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($conn, $check_sql);
    mysqli_stmt_bind_param($stmt, "ss", $id, $product_id);
    mysqli_stmt_execute($stmt);
    $check_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($check_result) > 0) {
        $response = ['success' => false, 'message' => '이미 장바구니에 추가된 상품입니다.'];
    } else {
        // 2. 삽입
        $insert_sql = "INSERT INTO cart_items (user_id, product_id) VALUES (?, ?)";
        $insert_stmt = mysqli_prepare($conn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "ss", $id, $product_id);
        $exec_result = mysqli_stmt_execute($insert_stmt);

        if ($exec_result) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false, 'message' => '장바구니 추가 실패'];
        }
        mysqli_stmt_close($insert_stmt);
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
echo json_encode($response);
?>
