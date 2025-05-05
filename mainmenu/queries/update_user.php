<?php
    session_start();
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_POST['id'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $postcode = $_POST['postcode'] ?? '';
    $address_detail = $_POST['address_detail'] ?? '';

    $sql = "UPDATE users SET name = '$name', email = '$email', phone = '$phone', address = '$address', postcode = '$postcode', address_detail = '$address_detail' WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        echo "<script>alert('회원 정보 수정 완료');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage_profile.php';</script>";
    } else {
        echo "<script>alert('회원 정보 수정 실패');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage_profile.php';</script>";
    }

    mysqli_close($conn);
?>