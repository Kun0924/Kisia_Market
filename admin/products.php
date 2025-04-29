<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품 관리 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>

        <!-- 메인 콘텐츠 -->
        <div class="main-content">
            <header class="admin-header">
                <h1>상품 관리</h1>
                <button class="add-product-btn">상품 추가</button>
            </header>
            <div class="content-wrapper">
                <div class="product-filters">
                    <select>
                        <option>전체 카테고리</option>
                        <option>키보드</option>
                        <option>마우스</option>
                        <option>마우스패드</option>
                        <option>액세서리</option>
                    </select>
                    <input type="text" placeholder="상품명 검색">
                    <button>검색</button>
                </div>
                <table class="product-table">
                    <thead>
                        <tr>
                            <th>상품 ID</th>
                            <th>상품명</th>
                            <th>카테고리</th>
                            <th>가격</th>
                            <th>재고</th>
                            <th>등록일</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="no-data">등록된 상품이 없습니다.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html> 