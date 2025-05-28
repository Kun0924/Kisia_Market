<?php
    require_once '/var/www/html/mainmenu/common/db.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $id = $_GET['id'];

    // inquiry 및 user 정보 조회 (LEFT JOIN)
    $sql = "SELECT inquiry.id, inquiry.user_id, inquiry.title, inquiry.content, inquiry.is_secret, 
            inquiry.type, inquiry.created_at, inquiry.secret_password, users.name,
            inquiry.inquiry_status, inquiry.answer, inquiry.answer_at
            FROM inquiry 
            LEFT JOIN users ON inquiry.user_id = users.id 
            WHERE inquiry.id = ?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $get_inquiry = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($get_inquiry) > 0) {
        $row = mysqli_fetch_assoc($get_inquiry);

        $currentUserId = $_SESSION['id'] ?? null;
        $currentUserRole = $_SESSION['role'] ?? null;

        if ($row['is_secret']) {
            if (!isset($currentUserId) || ($currentUserId != $row['user_id'] && $currentUserRole != 'ADMIN')) {
                echo "<script>
                    alert('비밀글입니다. 접근 권한이 없습니다.');
                    window.location.href = 'inquiry_list.php';
                </script>";
                exit;
            }
        }

        // 포인터를 처음으로 되돌림 (다시 fetch_assoc 하기 위해)
        mysqli_data_seek($get_inquiry, 0);
    }

    // inquiry 이미지 조회
    $sql_images = "SELECT * FROM inquiry_images WHERE inquiry_id = ?";
    $stmt_images = mysqli_prepare($conn, $sql_images);
    mysqli_stmt_bind_param($stmt_images, "i", $id);
    mysqli_stmt_execute($stmt_images);
    $get_inquiry_images = mysqli_stmt_get_result($stmt_images);

    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt_images);
    mysqli_close($conn);
?>
