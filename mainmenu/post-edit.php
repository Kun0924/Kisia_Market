<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/post-edit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <h2 class="page-title">게시글 수정</h2>
            <div class="post-edit-form">
                <form action="post_update.php" method="POST">
                    <div class="form-group">
                        <label for="title">제목</label>
                        <input type="text" id="title" name="title" value="게시글 제목" required>
                    </div>
                    <div class="form-group">
                        <label for="content">내용</label>
                        <textarea id="content" name="content" rows="10" required>게시글 내용이 여기에 들어갑니다.</textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">첨부파일</label>
                        <input type="file" id="file" name="file">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-save">저장</button>
                        <a href="post-detail.php" class="btn-cancel">취소</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 