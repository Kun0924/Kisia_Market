<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    session_start();

    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $currentUserId = $_SESSION['id'] ?? null;

    if ($currentUserId != $user_id) {
        echo "<script>
            alert('접근 권한이 없습니다.');
            window.location.href = 'inquiry_list.php';
        </script>";
        exit;
    }

    // $sql = "DELETE FROM users WHERE id = $user_id";
    // $result = mysqli_query($conn, $sql);

    // Prepared Statement 사용
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $result = $stmt->execute();
    $stmt->close();

    if ($result) {
        // 세션 종료
        session_destroy();
        echo "<script>alert('회원 탈퇴가 완료되었습니다.');</script>";
        echo "<script>window.location.href = '/';</script>";
    } else {
        echo "<script>alert('회원 탈퇴에 실패했습니다. 다시 시도해주세요.');</script>";
        echo "<script>window.location.href = '/';</script>";
    }
    
    mysqli_close($conn);
?>