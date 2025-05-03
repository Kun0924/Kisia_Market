<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $inquiry_id = $_POST['inquiry_id'];
    $secret_password = $_POST['secret_password'];

    $sql = "SELECT * FROM inquiry WHERE id = $inquiry_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['secret_password'] == $secret_password) {
        echo "<script>
            alert('비밀번호가 확인되었습니다.');
            window.location.href = '/mainmenu/inquiry_detail.php?id=$inquiry_id';
        </script>";
    } else {
        echo "<script>
            alert('비밀번호가 틀렸습니다.');
            history.back();
        </script>";
    }

    mysqli_close($conn);
?>