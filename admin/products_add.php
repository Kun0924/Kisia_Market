<?php
require_once '../mainmenu/common/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price = $_POST['price'] ?? '';
    $stock = $_POST['stock'] ?? '';
    $image_url = $_FILES['image']['name'] ?? '';
    $desc_url = $_FILES['description']['name'] ?? '';

    // 파일 업로드
    $uploadDir = '../uploads/';
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image_url);
    move_uploaded_file($_FILES['description']['tmp_name'], $uploadDir . $desc_url);

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
    <title>상품 추가 - 관리자</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .admin-form {
            max-width: 500px;
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
        <?php include 'sidebar.php'; ?>

        <div class="main-content">
            <header class="admin-header">
                <h1>상품 추가</h1>
            </header>

            <div class="content-wrapper">
                <form class="admin-form" method="post" enctype="multipart/form-data">
                    <!-- 상품명 -->
                    <label>
                        상품명
                        <input type="text" name="product_name" placeholder="상품명을 입력하세요" required>
                    </label>

                    <!-- 상품 이미지 업로드 -->
                    <label>
                        상품 이미지 업로드
                        <input type="file" name="product_image" accept="image/*">
                    </label>

                    <!-- 가격 -->
                    <label>
                        가격
                        <input type="number" name="price" placeholder="가격을 입력하세요" required>
                    </label>

                    <!-- 재고 -->
                    <label>
                        재고 수량
                        <input type="number" name="stock" placeholder="재고 수량을 입력하세요" required>
                    </label>

                    <!-- 설명 텍스트 -->
                    <label>
                        상품 설명
                        <textarea name="description" rows="4" placeholder="상품 설명을 입력하세요" required></textarea>
                    </label>

                    <!-- 설명 파일 업로드 -->
                    <label>
                        설명 파일 첨부 (PDF, Word 등)
                        <input type="file" name="description_file" accept=".pdf,.doc,.docx,.txt">
                    </label>

                    <!-- 버튼 -->
                    <div class="form-buttons">
                        <a href="products.php" class="cancel-btn">취소</a>
                        <button type="submit" class="add-product-btn">상품 등록</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
