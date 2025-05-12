<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $profile = $_POST['profile'] ?? '';

    $sql = "UPDATE users SET password = '$password' WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if ($profile == 'profile') {
            echo "<script>alert('비밀번호가 재설정되었습니다.'); window.location.href = '/mainmenu/mypage_profile.php';</script>";
        } else {
            echo "<script>alert('비밀번호가 재설정되었습니다.'); window.location.href = '/mainmenu/mypage_profile.php';</script>";
        }
    } else {
        echo "<script>alert('비밀번호 재설정에 실패했습니다.'); history.back();</script>";
    }

    mysqli_close($conn);
?>