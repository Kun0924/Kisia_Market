<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $inquiry_id = $_POST['inquiry_id'] ?? 'none';
    $type = $_POST['category'] ?? 'none';
    $title = $_POST['title'] ?? 'none';
    $content = $_POST['content'] ?? 'none';
    $isSecret = isset($_POST['isSecret']) ? 1 : 0;
    $secretPassword = isset($_POST['secretPassword']) ? $_POST['secretPassword'] : 'none';
    $userId = $_POST['user_id'] ?? 'none';
    $delete_files = $_POST['delete_files'] ?? '';

    if ($type == 'order') {
        $type = '주문/결제';
    } else if ($type == 'delivery') {
        $type = '배송';
    } else if ($type == 'return') {
        $type = '반품/교환';
    } else if ($type == 'product') {
        $type = '상품';
    } else if ($type == 'etc') {
        $type = '기타';
    }

    $sql = "UPDATE inquiry SET user_id = '$userId', type = '$type', title = '$title', content = '$content', is_secret = '$isSecret', secret_password = '$secretPassword' WHERE id = '$inquiry_id'";
    $result = mysqli_query($conn, $sql);

    if (!empty($delete_files)) {
        foreach ($delete_files as $file_id) {
            $sql = "DELETE FROM inquiry_images WHERE id = '$file_id'";
            mysqli_query($conn, $sql);
        }
    }

    // 첨부파일 업로드
    for($i = 0; $i < count($_FILES['file']['name']); $i++) {
        if ($_FILES['file']['name'][$i] == '') {
            continue;
        }
        if($_FILES['file']['error'][$i] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['file']['tmp_name'][$i];
            $fileName = $_FILES['file']['name'][$i];

            $uniqueFileName = uniqid() . '_' . $fileName;
            move_uploaded_file($tmpName, '/var/www/html/inquiry_uploads/' . $uniqueFileName);
            $image_url = '/inquiry_uploads/' . $uniqueFileName;

            $sql = "INSERT INTO inquiry_images (inquiry_id, image_url) VALUES ($inquiry_id, '$image_url')";
            mysqli_query($conn, $sql);
        } else {
            echo "파일 업로드 오류: " . $_FILES['file']['error'][$i];
            $result = false;
        }
    }

    if ($result) {
        echo "<script>
            alert('문의가 수정되었습니다.');
            window.location.href = '/mainmenu/inquiry_detail.php?id=$inquiry_id';
        </script>";
    } 
    else {
        echo "<script>
            alert('문의 수정에 실패했습니다.');
            history.back();
        </script>";
    }

    mysqli_close($conn);
?>