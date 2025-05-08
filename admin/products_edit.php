<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>상품 수정 - 관리자</title>
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
        .admin-form textarea,
        .admin-form select {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-top: 6px;
            box-sizing: border-box;
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
                <h1>상품 수정</h1>
            </header>

            <div class="content-wrapper">
                <form class="admin-form" method="post" action="products_update.php" enctype="multipart/form-data">
                    <!-- 상품명 -->
                    <label>
                        상품명
                        <input type="text" name="product_name" value="[기존 상품명]" required>
                    </label>

                    <!-- 카테고리 -->
                    <label>
                        카테고리
                        <select name="category" required>
                            <option value="keyboard">키보드</option>
                            <option value="mouse">마우스</option>
                            <option value="mousepad">마우스패드</option>
                            <option value="accessory">액세서리</option>
                        </select>
                    </label>

                    <!-- 가격 -->
                    <label>
                        가격
                        <input type="number" name="price" value="[기존 가격]" required>
                    </label>

                    <!-- 재고 -->
                    <label>
                        재고 수량
                        <input type="number" name="stock" value="[기존 재고]" required>
                    </label>

                    <!-- 상품 설명 -->
                    <label>
                        상품 설명
                        <textarea name="description" rows="5">[기존 설명]</textarea>
                    </label>

                    <!-- 상품 이미지 교체 (선택) -->
                    <label>
                        이미지 파일 변경 (선택)
                        <input type="file" name="product_image" accept="image/*">
                    </label>

                    <!-- 상품 ID 숨김 전달 -->
                    <input type="hidden" name="id" value="[상품 ID]">

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
