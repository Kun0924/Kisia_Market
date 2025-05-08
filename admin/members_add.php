<?php
require_once '../mainmenu/common/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // 사용자 입력을 그대로 사용
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $image_url = $_FILES['image']['name'] ?? '';
    $desc_url = $_FILES['description']['name'] ?? '';

    // 파일 업로드 (파일명 무작위화, 확장자 필터링 없이 그대로 저장)
    $uploadDir = '../uploads/';
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image_url);
    move_uploaded_file($_FILES['description']['tmp_name'], $uploadDir . $desc_url);

    // SQL 구문에 사용자 입력 직접 삽입 (SQL Injection 취약)
    $sql = "INSERT INTO products (name, category, price, stock, image_url, description, created_at)
            VALUES ('$name', '$category', '$price', '$stock', 'uploads/$image_url', 'uploads/$desc_url', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('상품이 등록되었습니다.'); location.href='products.php';</script>";
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

        .checkbox-group {
            margin-top: 10px;
        }

        .checkbox-group label {
            display: inline-block;
            margin-right: 15px;
            font-size: 14px;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 16px;
        }

        .add-product-btn {
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

        .add-product-btn:hover {
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
                        <input type="text" name="username" placeholder="회원 이름을 입력하세요" required>
                    </label>

                    <label>
                        아이디
                        <input type="text" name="real_id" placeholder="아이디를 입력하세요" required>
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
                        <button type="submit" class="add-product-btn">등록</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

