<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_POST['id'];
    $charge_amount = $_POST['charge_amount'] ?? 0;
    $custom_amount = $_POST['custom_amount'] ?? 0;

    if ($charge_amount == 'custom') {
        $charge_amount = $custom_amount;
    }   

    // 값 검증 (선택 사항, 보안을 더 강화하고 싶을 경우 사용)
    // $charge_amount = floatval($charge_amount);
    // $userId = intval($userId);

    // $sql = "UPDATE users SET point = point + $charge_amount WHERE id = $userId";
    // $result =  mysqli_query($conn, $sql);

    // Prepared Statement 사용
    $stmt = $conn->prepare("UPDATE users SET point = point + ? WHERE id = ?");
    $stmt->bind_param("di", $charge_amount, $userId); // d: double (포인트), i: integer (id)
    $result = $stmt->execute();

    if ($result) {
        echo "<script>alert('포인트 충전에 성공했습니다.');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage.php?tab=mypage_profile.php';</script>";
    } else {
        echo "<script>alert('포인트 충전에 실패했습니다.');</script>";
    }

    $stmt->close();
    mysqli_close($conn);
?>