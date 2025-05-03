<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="signup-container">
                <h2 class="page-title">회원가입</h2>
                <form class="signup-form" action="queries/insert_user.php" method="post" onsubmit="return checkForm()">
                    <div class="form-group">
                        <label for="username">아이디</label>
                        <span id="username_message" class="validation-message"></span>
                        <div class="username-wrapper">
                            <input type="text" id="username" name="username" placeholder="아이디를 입력하세요" required>
                            <button type="button" class="btn-check-duplicate">중복확인</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input type="password" id="password" name="password" placeholder="비밀번호를 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="password_check">비밀번호 확인</label> 
                        <span id="password_message"></span>
                        <input type="password" id="password_check" name="password_check" placeholder="비밀번호를 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="name">이름</label>
                        <input type="text" id="name" name="name" placeholder="이름을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="email">이메일</label>
                        <input type="email" id="email" name="email" placeholder="이메일을 입력하세요" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">휴대폰 번호</label>
                        <input type="tel" id="phone" name="phone" placeholder="휴대폰 번호를 입력하세요" required>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-signup">가입하기</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
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
            const password = document.getElementById("password").value;
            const passwordCheck = document.getElementById("password_check").value;

            if (isUsernameDuplicate) {
                alert("아이디 중복 확인을 해주세요.");
                return false;
            }

            if (password !== passwordCheck) {
                alert("비밀번호가 일치하지 않습니다.");
                return false; 
            }

            return true; 
        }
        
        //아이디 중복체크
        let isUsernameDuplicate = true;
        document.querySelector(".btn-check-duplicate").addEventListener("click", function () {
        const username = document.getElementById("username").value;
        const message = document.getElementById("username_message");

        if (username === "") {
            message.textContent = "아이디를 입력하세요.";
            message.style.color = "red";
            isUsernameDuplicate = true;
            return;
        }
        fetch("queries/check_userId.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "username="  + username
        })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                message.textContent = "이미 사용 중인 아이디입니다.";
                message.style.color = "red";
                isUsernameDuplicate = true;
                } else {
                message.textContent = "사용 가능한 아이디입니다.";
                message.style.color = "green";
                isUsernameDuplicate = false;
                }
            })
        });
    </script>

</body>
</html> 