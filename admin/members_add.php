<!DOCTYPE html>
<html lang="ko">
<head>
<head>
    <meta charset="UTF-8">
    <title>회원 추가 - 관리자</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .admin-form {
            max-width: 400px;
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

        .admin-form input {
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

        .admin-form .add-product-btn {
            display: inline-block;
            width: 100%;
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

        .admin-form .add-product-btn:hover {
            background-color: #27ae60;
        }
        .form-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 16px;
        }

        .add-product-btn {
            flex: 1;
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
</head>
<body>
<div class="admin-container">
    <?php include 'sidebar.php'; ?>
    
    <div class="main-content">
        <header class="admin-header">
            <h1>회원 추가</h1>
        </header>
        <div class="content-wrapper">
            <form class="admin-form">
                <label>
                    아이디
                    <input type="text" name="userId" placeholder="아이디를 입력하세요" required>
                </label>
                <label>
                    비밀번호
                    <input type="password" name="password" placeholder="비밀번호를 입력하세요" required>
                </label>
                <label>
                    이름
                    <input type="text" name="name" placeholder="이름을 입력하세요" required>
                </label>
                <label>
                    이메일
                    <input type="email" name="email" placeholder="이메일을 입력하세요" required>
                </label>
                <label>
                    전화번호
                    <input type="phone" name="phone" placeholder="전화번호를 입력하세요" required>
                </label>
                <div class="form-buttons">
                    <a href="members.php" class="cancel-btn">취소</a>
                    <button type="submit" class="add-product-btn">회원 등록</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
