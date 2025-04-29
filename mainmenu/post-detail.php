<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 상세 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/post-detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="post-detail">
                <div class="post-header">
                    <h2 class="post-title">게시글 제목</h2>
                    <div class="post-meta">
                        <span class="author">작성자: 홍길동</span>
                        <span class="date">작성일: 2024-04-28</span>
                        <span class="views">조회수: 123</span>
                    </div>
                </div>
                <div class="post-content">
                    <p>게시글 내용이 여기에 들어갑니다.</p>
                </div>
                <div class="post-actions">
                    <button class="btn-like"><i class="fas fa-heart"></i> 좋아요</button>
                    <button class="btn-share"><i class="fas fa-share"></i> 공유하기</button>
                </div>
                <div class="post-comments">
                    <h3>댓글</h3>
                    <div class="comment-form">
                        <textarea placeholder="댓글을 입력하세요"></textarea>
                        <button class="btn-comment">댓글 작성</button>
                    </div>
                    <div class="comment-list">
                        <div class="comment-item">
                            <div class="comment-header">
                                <span class="comment-author">김철수</span>
                                <span class="comment-date">2024-04-28</span>
                            </div>
                            <div class="comment-content">
                                <p>댓글 내용입니다.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 