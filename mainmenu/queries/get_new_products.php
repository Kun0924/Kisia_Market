<?php
        require_once 'mainmenu/common/db.php';

        $sql1 = "SELECT * FROM products ORDER BY id DESC LIMIT 3"; // 신상품 3개 가져오기
        $get_new_products = mysqli_query($conn, $sql1);

        // 데이터 복사해서 가져오기 (출력 아님, 그냥 콘솔에서 확인용)
        // $data = mysqli_fetch_all(mysqli_query($conn, $sql), MYSQLI_ASSOC);
        // $jsonData = json_encode($data);
        // echo "<script>console.log(" . $jsonData . ");</script>";

        mysqli_close($conn); // 연결 종료
        ?>