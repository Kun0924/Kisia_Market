<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $email_result = mysqli_query($conn, $email_check);
    $email_row = mysqli_fetch_assoc($email_result);

    if ($email_row) {
        echo "<script>alert('이미 사용중인 이메일입니다.'); history.back();</script>";
        exit;
    }

    $sql = "INSERT INTO users (userId, password, name, email, phone) VALUES ('$userId', '$password', '$name', '$email', '$phone')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
            alert('회원가입이 완료되었습니다.');
            window.location.href = '/mainmenu/login.php';
        </script>";
    } else {
        echo "<script>
            alert('회원가입에 실패했습니다.');
            history.back();
        </script>";
    }

    mysqli_close($conn);
?>