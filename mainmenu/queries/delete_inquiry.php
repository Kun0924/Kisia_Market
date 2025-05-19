<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];

    $img_sql = "SELECT image_url FROM inquiry_images WHERE inquiry_id = $id";
    $img_result = mysqli_query($conn, $img_sql);

    if ($img_result && mysqli_num_rows($img_result) > 0) {
        while ($img_row = mysqli_fetch_assoc($img_result)) {
            $img_path = '/var/www/html' . $img_row['image_url'];
            if (!empty($img_path) && file_exists($img_path)) {
                system("rm $img_path");
            }
        }
    }

    $sql = "DELETE FROM inquiry WHERE id = $id";
    $result = mysqli_query($conn, $sql);


    if ($result) {
        echo "<script>alert('문의글 삭제에 성공했습니다.');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage.php?tab=mypage_inquiry.php';</script>";
    } else {
        echo "<script>alert('문의글 삭제에 실패했습니다.');</script>";
    }

    mysqli_close($conn);
?>