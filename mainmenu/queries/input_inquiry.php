<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $type = $_POST['category'] ?? '';
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $isSecret = isset($_POST['isSecret']) ? 1 : 0;
    $secretPassword = isset($_POST['secretPassword']) ? $_POST['secretPassword'] : '';
    $userId = $_POST['id'] ?? '';

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

    $sql = "INSERT INTO inquiry (user_id, type, title, content, is_secret, secret_password) VALUES ('$userId', '$type', '$title', '$content', '$isSecret', '$secretPassword')";
    $result = mysqli_query($conn, $sql);

    // 새로 생성된 문의글 ID 가져오기
    $inquiry_id = mysqli_insert_id($conn);

    // 첨부파일 업로드
    for($i = 0; $i < count($_FILES['file']['name']); $i++) {
        if ($_FILES['file']['name'][$i] == '') {
            continue;
        }
        if($_FILES['file']['error'][$i] === UPLOAD_ERR_OK) {
            $tmpName = $_FILES['file']['tmp_name'][$i];
            $fileName = $_FILES['file']['name'][$i];

            $uniqueFileName = uniqid() . '_' . basename($fileName);
            move_uploaded_file($tmpName, '/var/www/html/inquiry_uploads/' . $uniqueFileName);

            $sql = "INSERT INTO inquiry_images (inquiry_id, image_url) VALUES ($inquiry_id, '$uniqueFileName')";
            mysqli_query($conn, $sql);
        } else {
            echo "파일 업로드 오류: " . $_FILES['file']['error'][$i];
            $result = false;
        }
    }

    if ($result) {
        echo "<script>
            alert('문의가 완료되었습니다.');
            window.location.href = '/mainmenu/inquiry_list.php';
        </script>";
    } 
    // else {
    //     echo "<script>
    //         alert('문의에 실패했습니다.');
    //         history.back();
    //     </script>";
    // }

    mysqli_close($conn);
?>