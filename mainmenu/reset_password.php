<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>비밀번호 재설정 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <main class="main-content">
        <div class="find-container">
            <div class="find-form-container">
                <h2 class="page-title">비밀번호 재설정</h2>
                <form class="find-form" action="queries/reset_password.php" method="POST" onsubmit="return checkForm()">
                    <input type="hidden" name="email" value="<?php echo $_GET['email'] ?? ''; ?>">
                    <input type="hidden" name="profile" value="<?php echo $_GET['profile'] ?? ''; ?>">
                    <div class="form-group">
                        <label for="password">새 비밀번호</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_check">새 비밀번호 확인</label>
                        <span id="password_message"></span>
                        <input type="password" id="password_check" name="password_check" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-find">비밀번호 재설정</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
    <script>
        const password = document.getElementById('password');
        const passwordCheck = document.getElementById('password_check');
        const message = document.getElementById('password_message');

        function validatePassword() {
            if (passwordCheck.value === "") {
                message.textContent = "";
                return;
            }

            if (password.value === passwordCheck.value) {
                message.style.color = "green";
                message.textContent = "비밀번호가 일치합니다.";
            } else {
                message.style.color = "red";
                message.textContent = "비밀번호가 일치하지 않습니다.";
            }
        }

        password.addEventListener('keyup', validatePassword);
        passwordCheck.addEventListener('keyup', validatePassword);

        function checkForm() {
            if (password.value !== passwordCheck.value) {
                alert("비밀번호가 일치하지 않습니다.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html> 