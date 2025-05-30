<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $token = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';
    $profile = $_POST['profile'] ?? '';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE reset_token = ? AND reset_token_expiry > NOW()";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $token);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if (!$user) {
        echo "<script>alert('유효하지 않거나 만료된 링크입니다.'); history.back();</script>";
        exit;
    }

    // prepared statement 사용
    $stmt = mysqli_prepare($conn, "UPDATE users SET password = ?, reset_token = NULL, reset_token_expiry = NULL WHERE reset_token = ?");
    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $token);
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