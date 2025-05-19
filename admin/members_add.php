<?php
require_once '../mainmenu/common/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = $_POST['userId'] ?? '';
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $phone = $_POST['phone'] ?? '';

    $sql = "INSERT INTO users (userId, name, email, password, phone, created_at)
            VALUES ('$userId', '$name', '$email', '$password', '$phone', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('회원이 등록되었습니다.'); location.href='members.php';</script>";
    } else {
        echo "<script>alert('등록 실패: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원 추가 - 관리자</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .admin-form {
            max-width: 600px;
            margin: 0 auto;
            padding: 24px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .admin-form label {
            display: block;
            margin-bottom: 16px;
            font-size: 14px;
            color: #333;
        }

        .admin-form input[type="text"],
        .admin-form input[type="email"],
        .admin-form input[type="password"],
        .admin-form input[type="tel"] {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 6px;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .admin-form input:focus {
            border-color: #2ecc71;
            outline: none;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 16px;
        }

        .add-member-btn {
            flex: 1;
            padding: 10px;
            font-size: 15px;
            font-weight: 500;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-member-btn:hover {
            background-color: #27ae60;
        }

        .cancel-btn {
            flex: 1;
            display: inline-block;
            text-align: center;
            padding: 10px;
            font-size: 15px;
            font-weight: 500;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .cancel-btn:hover {
            background-color: #c0392b;
        }

        .username-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 6px;
        }

        .username-wrapper input {
            margin-top: 0 !important;
        }

        .btn-check-duplicate {
            padding: 10px 15px;
            font-size: 14px;
            font-weight: 500;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            white-space: nowrap;
            transition: background-color 0.3s;
        }

        .btn-check-duplicate:hover {
            background-color: #2980b9;
        }

        .validation-message {
            display: block;
            margin-top: 5px;
            font-size: 13px;
        }

        .validation-message.success {
            color: #2ecc71;
        }

        .validation-message.error {
            color: #e74c3c;
        }
    </style>
</head>
<body>
<div class="admin-container">
    <?php include 'topbar.php'; ?>

    <div class="main-content">
        <header class="admin-header">
            <h1>회원 추가</h1>
        </header>

        <div class="content-wrapper">
        <form class="admin-form" method="POST" action="">
            <label>
                이름
                <input type="text" name="name" placeholder="이름을 입력하세요" required>
            </label>

            <label>
                아이디
                <div class="username-wrapper">
                    <input type="text" name="userId" id="userId" placeholder="아이디를 입력하세요" required>
                    <button type="button" class="btn-check-duplicate">중복확인</button>
                </div>
                <span id="username_message" class="validation-message"></span>
            </label>

            <label>
                비밀번호
                <input type="password" name="password" placeholder="비밀번호를 입력하세요" required>
            </label>

            <label>
                이메일
                <input type="email" name="email" placeholder="이메일을 입력하세요" required>
            </label>

            <label>
                전화번호
                <input type="tel" name="phone" placeholder="전화번호를 입력하세요">
            </label>

            <div class="form-buttons">
                <a href="members.php" class="cancel-btn">취소</a>
                <button type="submit" class="add-member-btn">등록</button>
            </div>
        </form>

        </div>
    </div>
</div>
<script>
    // 아이디 중복체크
    let isUsernameDuplicate = true;
    document.querySelector(".btn-check-duplicate").addEventListener("click", function () {
        const username = document.getElementById("userId").value;
        const message = document.getElementById("username_message");

        if (username === "") {
            message.textContent = "아이디를 입력하세요.";
            message.style.color = "red";
            isUsernameDuplicate = true;
            return;
        }

        fetch("../mainmenu/queries/check_userId.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "username=" + username
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
        });
    });

    // 폼 제출 전 중복확인 검사
    document.querySelector(".admin-form").addEventListener("submit", function(e) {
        if (isUsernameDuplicate) {
            e.preventDefault();
            alert("아이디 중복 확인을 해주세요.");
            return false;
        }
    });
</script>
</body>
</html>
