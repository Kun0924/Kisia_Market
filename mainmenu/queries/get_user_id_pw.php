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
        $sql = "SELECT * FROM users WHERE name = '$name' AND email = '$email' AND phone = '$phone'";
        $result = mysqli_query($conn, $sql);
        $user = $result->fetch_assoc();
    } else {
        $sql = "SELECT * FROM users WHERE name = '$name' AND email = '$email' AND phone = '$phone' AND userId = '$user_id'";
        $result = mysqli_query($conn, $sql);
        $user_pw = $result->fetch_assoc();

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
                $mail->Body    = '비밀번호를 재설정하려면 <a href="http://kisia-shop1.koreacentral.cloudapp.azure.com/mainmenu/reset_password.php?email=' . $email . '&profile=' . $profile . '">여기</a>를 클릭하세요.';

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
    }

    mysqli_close($conn);
?>
