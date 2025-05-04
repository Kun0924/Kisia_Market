<?php
    session_start();
    require_once '/var/www/html/mainmenu/common/db.php';

    $userId = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM users WHERE userId = '$userId' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $user = $result->fetch_assoc();

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['userId'] = $user['userId'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['userId'] === 'admin') {
            header("Location: /admin/dashboard_main.php");
        } else {
            header("Location: /index.php");
        }        
        
        exit();
    } else {
        echo "<script>
            alert('아이디 또는 비밀번호가 잘못되었습니다.');
            window.location.href = '/mainmenu/login.php';
        </script>";
    }
    
    mysqli_close($conn);
?>