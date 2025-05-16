<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>고객센터 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/customer-service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_notice.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="list-container">
            <div class="category-tabs">
                <a href="customer-service.php"><button class="tab-btn active">공지사항</button></a>
                <a href="inquiry_list.php"><button class="tab-btn">문의사항</button></a>
            </div>
            <div class="notice-section" id="noticeSection">
                <div class="notice-header">
                    <div class="notice-title">공지사항</div>
                    <div class="notice-search">
                        <form action="customer-service.php" method="get">
                            <input type="text" name="search_query" placeholder="공지사항 검색">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="notice-list">
                    <div class="list-header">
                        <span class="header-title">제목</span>
                        <span class="header-meta">번호</span>
                        <span class="header-user">작성자</span>
                        <span class="header-date">작성일</span>
                    </div>

                    <?php if (mysqli_num_rows($get_notice) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($get_notice)): ?>
                            <div class="qna-item notice-item">
                                <div class="qna-info">
                                    <a href="notice_detail.php?id=<?= $row['id'] ?>" class="qna-title"><?= $row['title'] ?></a>
                                    <span class="qna-meta"><?= $row['id'] ?></span>
                                    <span class="qna-user">관리자</span>
                                    <span class="qna-date"><?= date('Y-m-d', strtotime($row['created_at'])) ?></span>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p style="padding: 10px;">등록된 공지사항이 없습니다.</p>
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