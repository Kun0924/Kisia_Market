<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];

    // $img_sql = "SELECT image_url FROM inquiry_images WHERE inquiry_id = $id";
    // $img_result = mysqli_query($conn, $img_sql);

    // 이미지 경로 조회 (Prepared Statement)
    $stmt = $conn->prepare("SELECT image_url FROM inquiry_images WHERE inquiry_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($img_row = $result->fetch_assoc()) {
            $img_path = '/var/www/html' . $img_row['image_url'];

            // 파일이 존재하는 경우만 삭제
            if (file_exists($img_path) && strpos(realpath($img_path), '/var/www/html') === 0) {
                unlink($img_path); // system() 대신 unlink() 사용 (더 안전)
            }
        }
    }
    $stmt->close();

    // $sql = "DELETE FROM inquiry WHERE id = $id";
    // $result = mysqli_query($conn, $sql);

    // 문의글 삭제
    $stmt = $conn->prepare("DELETE FROM inquiry WHERE id = ?");
    $stmt->bind_param("i", $id);
    $success = $stmt->execute();
    $stmt->close();

    if ($success) {
        echo "<script>alert('문의글 삭제에 성공했습니다.');</script>";
        echo "<script>window.location.href = '/mainmenu/mypage.php?tab=mypage_inquiry.php';</script>";
    } else {
        echo "<script>alert('문의글 삭제에 실패했습니다.');</script>";
    }

    mysqli_close($conn);
?>