<?php
    require_once '/var/www/html/mainmenu/common/db.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '/var/www/html/vendor/autoload.php';

    $find_type = $_POST['find_type'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $profile = isset($_POST['profile']) ? $_POST['profile'] : '';

    $user_id = $_POST['user_id'] ?? '';

    if ($find_type == 'find_id') {
        $sql = "SELECT * FROM users WHERE name = ? AND email = ? AND phone = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $phone);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    } else {
        $sql = "SELECT * FROM users WHERE name = ? AND email = ? AND phone = ? AND userId = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user_pw = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    }

        if ($user_pw) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'mailhog'; // MailHog 컨테이너 이름
                $mail->Port = 1025;
                $mail->SMTPAuth = false;

                $mail->setFrom('noreply@kisia.local', 'KISIA Market');
                $mail->addAddress($email, '사용자');

                $mail->CharSet = 'UTF-8';        // 문자 인코딩
                $mail->Encoding = 'base64';      // Content-Transfer-Encoding 설정

                $mail->isHTML(true);
                $mail->Subject = '비밀번호 재설정 안내';
                $mail->Body    = '비밀번호를 재설정하려면 <a href="https://kisia-shop-secure.koreasouth.cloudapp.azure.com//mainmenu/reset_password.php?email=' . $email . '&profile=' . $profile . '">여기</a>를 클릭하세요.';

                $mail->send();
            } catch (Exception $e) {
                $error_msg = '메일 전송 실패: ' . $mail->ErrorInfo;
            }
        } else {
            $error_msg = '존재하지 않는 사용자입니다.';
        }

        if ($profile == 'profile') {
            echo json_encode(['success' => true]);
        }
    
    mysqli_close($conn);
?>
