<?php
require_once '../mainmenu/common/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inquiry_id'])) {
    $inquiry_id = $_POST['inquiry_id']; 

    $sql = "UPDATE inquiry SET answer = NULL, inquiry_status = '답변 대기' WHERE id = $inquiry_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
                alert('답변이 삭제되었습니다.');
                location.href='inquiries.php';
              </script>";
    } else {
        echo "<script>
                alert('답변 삭제에 실패했습니다.');
                history.back();
              </script>";
    }
} else {
    echo "<script>
            alert('잘못된 요청입니다.');
            history.back();
          </script>";
}
