<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $profile = $_POST['profile'] ?? '';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // prepared statement 사용
    $stmt = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $email);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    if ($result) {
        if ($profile == 'profile') {
            echo "<script>alert('비밀번호가 재설정되었습니다.'); window.location.href = '/mainmenu/mypage_profile.php';</script>";
        } else {
            echo "<script>alert('비밀번호가 재설정되었습니다.'); window.location.href = '/';</script>";
        }
    } else {
        echo "<script>alert('비밀번호 재설정에 실패했습니다.'); history.back();</script>";
    }

    mysqli_close($conn);
?>