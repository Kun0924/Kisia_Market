<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KISIA SHOP - 신상품</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <main class="main-content">
        <div class="container">
            <div class="category-header">
                <h1>신상품</h1>
            </div>
            
            <div class="filter-section">
                <div class="filter-group">
                    <label>정렬</label>
                    <select>
                        <option value="newest">최신순</option>
                        <option value="price-low">가격 낮은순</option>
                        <option value="price-high">가격 높은순</option>
                        <option value="popular">평점 높은순</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>가격대</label>
                    <select>
                        <option value="all">전체</option>
                        <option value="0-50000">5만원 이하</option>
                        <option value="50000-100000">5만원-10만원</option>
                        <option value="100000-150000">10만원-15만원</option>
                        <option value="150000-200000">15만원-20만원</option>
                        <option value="200000-up">20만원 이상</option>
                    </select>
                </div>
            </div>

            <div class="content-section">
                <p>여기는 신상품 페이지입니다. 최신에 등록된 다양한 제품을 구매할 수 있습니다.</p>
            </div>

            <div class="pagination">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#" class="next">다음 <i class="fas fa-chevron-right"></i></a>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 