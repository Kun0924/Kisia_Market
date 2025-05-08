<?php
require_once '../mainmenu/common/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';

    $sql = "INSERT INTO notices (title, content, created_at)
            VALUES ('$title', '$content', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('공지사항이 등록되었습니다.'); location.href='notices.php';</script>";
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
    <title>공지사항 작성 - 관리자</title>
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

        .admin-form input,
        .admin-form textarea {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 6px;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .admin-form input:focus,
        .admin-form textarea:focus {
            border-color: #2ecc71;
            outline: none;
        }

        .admin-form input[type="file"] {
            margin-top: 6px;
            font-size: 14px;
            color: #333;
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
                <h1>공지사항 작성</h1>
            </header>

            <div class="content-wrapper">
                <form class="admin-form" method="POST" action="">
                    <!-- 제목 -->
                    <label>
                        제목
                        <input type="text" name="title" placeholder="공지 제목을 입력하세요" required>
                    </label>

                    <!-- 내용 -->
                    <label>
                        내용
                        <textarea name="content" rows="6" placeholder="공지 내용을 입력하세요" required></textarea>
                    </label>

                    <!-- 버튼 -->
                    <div class="form-buttons">
                        <a href="notices.php" class="cancel-btn">취소</a>
                        <button type="submit" class="add-product-btn">등록</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
