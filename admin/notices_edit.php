<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>공지사항 수정 - 관리자</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .admin-form {
            max-width: 700px;
            margin: 0 auto;
            padding: 24px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .admin-form .form-group {
            margin-bottom: 20px;
        }

        .admin-form label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
        }

        .admin-form input,
        .admin-form textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }

        .submit-btn {
            flex: 1;
            padding: 10px;
            background-color: #2ecc71;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #27ae60;
        }

        .cancel-btn {
            flex: 1;
            padding: 10px;
            background-color: #e74c3c;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .cancel-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>

        <div class="main-content">
            <header class="admin-header">
                <h1>공지사항 수정</h1>
            </header>

            <div class="content-wrapper">
                <form class="admin-form" method="post" action="notices_update.php">
                    <!-- 기존 제목 표시 -->
                    <div class="form-group">
                        <label for="title">제목</label>
                        <input type="text" name="title" id="title" value="[기존 제목]" required>
                    </div>

                    <!-- 기존 내용 표시 -->
                    <div class="form-group">
                        <label for="content">내용</label>
                        <textarea name="content" id="content" rows="8" required>[기존 내용]</textarea>
                    </div>

                    <!-- 히든 ID 전달 -->
                    <input type="hidden" name="id" value="[공지 ID]">

                    <!-- 버튼 -->
                    <div class="form-buttons">
                        <button type="submit" class="submit-btn">수정 완료</button>
                        <button type="button" class="cancel-btn" onclick="history.back()">취소</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
