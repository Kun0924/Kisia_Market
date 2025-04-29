<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1:1 문의 작성 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/inquiry-write.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <h2 class="page-title">1:1 문의 작성</h2>
            <div class="inquiry-form">
                <form action="inquiry_process.php" method="POST">
                    <div class="form-group">
                        <label for="category">문의 유형</label>
                        <select id="category" name="category" required>
                            <option value="">선택하세요</option>
                            <option value="order">주문/결제</option>
                            <option value="delivery">배송</option>
                            <option value="return">반품/교환</option>
                            <option value="product">상품</option>
                            <option value="etc">기타</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">제목</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="content">내용</label>
                        <textarea id="content" name="content" rows="10" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">첨부파일</label>
                        <input type="file" id="file" name="file">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">문의하기</button>
                        <a href="customer-service.php" class="btn-cancel">취소</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 