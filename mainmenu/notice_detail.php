<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공지사항 상세 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/notice_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_notice_detail.php'; ?>

    <!-- Main Content -->
    <main class="notice-main-content">
    <div class="notice-container">
        <div class="notice-post-detail">
            <?php if (mysqli_num_rows($get_notice) > 0) { ?>
            <?php $row = mysqli_fetch_assoc($get_notice); ?>
            <div class="notice-post-header">
                <h2 class="notice-post-title"><?= $row['title'] ?></h2>
                <div class="notice-post-meta">
                    <span class="notice-author">작성자: 관리자</span>
                    <span class="notice-date">작성일: <?= date("Y-m-d", strtotime($row['created_at'])) ?></span>
                </div>
            </div>
            <div class="notice-post-content">
                <p><?= nl2br($row['content']) ?></p>
            </div>
            <?php } else { ?>
                <p>공지사항이 없습니다.</p>
            <?php } ?>
        </div>
    </div>
</main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 