<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>문의사항 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/customer-service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_inquiry_list.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="list-container">
            <div class="category-tabs">
                <a href="customer-service.php"><button class="tab-btn">공지사항</button></a>
                <a href="inquiry_list.php"><button class="tab-btn active">문의사항</button></a>
            </div>

            <div class="qna-section" id="qnaSection">
                <div class="qna-header">
                    <div class="qna-title">문의사항</div>
                    <div class="qna-search">
                        <input type="text" placeholder="문의사항 검색">
                        <button><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="qna-list">
                    <div class="list-header">
                        <span class="header-title">제목</span>
                        <span class="header-type">유형</span>
                        <span class="header-meta">번호</span>
                        <span class="header-user">작성자</span>
                        <span class="header-date">작성일</span>
                        <span class="header-status">상태</span>
                    </div>
                    <?php if (mysqli_num_rows($get_inquiry) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($get_inquiry)): ?>
                            <div class="qna-item">
                                <div class="qna-info">
                                    <?php if ($row['is_secret']): ?>
                                        <a href="inquiry_check_secret.php?id=<?= $row['id'] ?>" class="qna-title">
                                            🔒 비밀글입니다
                                        </a>
                                    <?php else: ?>
                                        <a href="inquiry_detail.php?id=<?= $row['id'] ?>" class="qna-title">
                                            <?= $row['title'] ?>
                                        </a>
                                    <?php endif; ?>
                                    <span class="qna-type"><?= $row['type'] ?></span>
                                    <span class="qna-meta"><?= $row['id'] ?></span>
                                    <span class="qna-user"><?= $row['userId'] ?></span>
                                    <span class="qna-date"><?= date('Y-m-d', strtotime($row['created_at'])) ?></span>
                                    <span class="<?= $row['inquiry_status'] == '답변 완료' ? 'inquiry-status_done' : 'inquiry-status' ?>">
                                        <?= $row['inquiry_status'] == '답변 완료' ? '답변 완료' : '답변 대기' ?>
                                    </span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p style="padding: 10px;">등록된 문의글이 없습니다.</p>
                    <?php endif; ?>
                </div>
                <div class="write-btn-container">
                    <?php if ($userId): ?>
                        <button class="write-btn" onclick="window.location.href='inquiry-write.php'">글쓰기</button>
                    <?php endif; ?>
                </div>
            </div>
            <div class="pagination">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    $active = $i == $page ? 'active' : '';
                    echo "<a href='?page=$i' class='$active'>$i</a>";
                }
                if ($page < $total_pages) {
                    $next_page = $page + 1;
                    echo "<a href='?page=$next_page' class='next'>다음 <i class='fas fa-chevron-right'></i></a>";
                }
                ?>
            </div>
        </div>
    </main>
    <?php include 'common/footer.php'; ?>
</body>
</html> 