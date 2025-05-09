<?php
require_once '../mainmenu/common/db.php';

// 상품 ID 가져오기
$product_id = $_GET['id'] ?? 0;

// DB에서 해당 상품 정보 가져오기
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['product_name'] ?? '';
    $category = $_POST['category'] ?? '';  // 카테고리 항목이 현재 없음
    $short_description = $_POST['product_short_description'] ?? '';
    $price = $_POST['price'] ?? 0;
    $stock = $_POST['stock'] ?? 0;

    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // 파일 이름 처리
    $image_url = $_FILES['product_image']['name'] ?? '';
    $desc_url = $_FILES['description_file']['name'] ?? '';

    if ($image_url) {
        $image_url = uniqid() . '_' . $image_url;
        $image_sql = "UPDATE products SET image_url = 'uploads/$image_url' WHERE id = $product_id";
        mysqli_query($conn, $image_sql);
        // 실제 업로드 수행
        $image_uploaded = move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadDir . $image_url);
        if (!$image_uploaded) {
            echo "<script>alert('상품 이미지 업로드에 실패했습니다.'); history.back();</script>";
            exit;
    }
    }
    if ($desc_url) {
        $desc_url = uniqid() . '_' . $desc_url;
        $desc_sql = "UPDATE products SET description = 'uploads/$desc_url' WHERE id = $product_id";
        mysqli_query($conn, $desc_sql);
        // 실제 업로드 수행
        $desc_uploaded = move_uploaded_file($_FILES['description_file']['tmp_name'], $uploadDir . $desc_url);
        if ($_FILES['description_file']['error'] !== UPLOAD_ERR_OK) {
            echo "오류 코드: " . $_FILES['description_file']['error'];
            exit;
        }
        if (!$desc_uploaded) {
            echo "<script>alert('상품 설명 파일 업로드에 실패했습니다.'); history.back();</script>";
            exit;
        }
    }

    $sql = "UPDATE products SET name = '$name', category = '$category', short_description = '$short_description', price = '$price', 
            stock = '$stock' WHERE id = $product_id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('상품이 수정되었습니다.'); location.href='products.php';</script>";
    } else {
        echo "<script>alert('수정 실패: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_close($conn);
}
?>
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
        .image-upload-wrapper {
            margin-top: 10px;
        }
        .image-preview-container {
            margin-top: 10px;
            max-width: 300px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            background-color: #fff;
        }
        .image-preview {
            width: 100%;
            height: auto;
            max-height: 200px;
            object-fit: contain;
        }
        input[type="file"] {
            display: block;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
        }
        input[type="file"]::-webkit-file-upload-button {
            background-color: #3498db;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        input[type="file"]::-webkit-file-upload-button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <?php include 'topbar.php'; ?>
        <div class="main-content">
            <header class="admin-header">
                <h1>상품 수정</h1>
            </header>
            <div class="content-wrapper">
                <form class="admin-form" method="post" enctype="multipart/form-data">
                    <label>
                        상품명
                        <input type="text" name="product_name" value="<?= $product['name'] ?>" required>
                    </label>
                    <label>
                        상품 이미지 업로드
                        <div class="image-upload-wrapper">
                            <input type="file" name="product_image" id="product_image" accept="image/*">
                            <div class="image-preview-container">
                                <?php if (!empty($product['image_url'])): ?>
                                    <img src="/<?= $product['image_url'] ?>" alt="상품 이미지" id="product_image_preview" class="image-preview">
                                <?php else: ?>
                                    <img src="" alt="상품 이미지" id="product_image_preview" class="image-preview" style="display: none;">
                                <?php endif; ?>
                            </div>
                        </div>
                    </label>
                    <label>
                        카테고리
                        <select name="category" required>
                            <option value="keyboard" <?= $product['category'] === 'keyboard' ? 'selected' : '' ?>>키보드</option>
                            <option value="mouse" <?= $product['category'] === 'mouse' ? 'selected' : '' ?>>마우스</option>
                            <option value="mousepad" <?= $product['category'] === 'mousepad' ? 'selected' : '' ?>>마우스패드</option>
                            <option value="accessory" <?= $product['category'] === 'accessory' ? 'selected' : '' ?>>액세서리</option>
                        </select>
                    </label>
                    <label>
                        가격
                        <input type="number" name="price" value="<?= $product['price'] ?>" required>
                    </label>
                    <label>
                        재고 수량
                        <input type="number" name="stock" value="<?= $product['stock'] ?>" required>
                    </label>
                    <label>
                        상품 설명
                        <textarea name="product_short_description" rows="5"><?= $product['short_description'] ?></textarea>
                    </label>
                    <label>
                        이미지 파일 변경
                        <div class="image-upload-wrapper">
                            <input type="file" name="description_file" id="description_file" accept="image/*">
                            <div class="image-preview-container">
                                <?php if (!empty($product['description'])): ?>
                                    <img src="/<?= $product['description'] ?>" alt="상세 이미지" id="description_file_preview" class="image-preview">
                                <?php else: ?>
                                    <img src="" alt="상세 이미지" id="description_file_preview" class="image-preview" style="display: none;">
                                <?php endif; ?>
                            </div>
                        </div>
                    </label>
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <div class="form-buttons">
                        <button type="button" class="cancel-btn" onclick="history.back()">취소</button>
                        <button type="submit" class="submit-btn">수정 완료</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
