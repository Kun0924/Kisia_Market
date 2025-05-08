<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>문의글 상세 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/inquiry_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_inquiry_detail.php'; ?>

    <!-- Main Content -->
    <main class="inquiry-main-content">
        <div class="inquiry-container">
            <div class="inquiry-post-detail">
                <?php if (mysqli_num_rows($get_inquiry) > 0) { ?>
                <?php $row = mysqli_fetch_assoc($get_inquiry); ?>
                <div class="inquiry-post-header">
                    <span class="inquiry-category">
                        <?php echo $row['type'];?>
                    </span>
                    <h2 class="inquiry-post-title"><?= $row['title'] ?></h2>
                    <div class="inquiry-post-meta">
                        <span class="inquiry-author">작성자: <?= $row['name'] ? $row['name'] : '탈퇴한 회원' ?></span>
                        <span class="inquiry-date">작성일: <?= date("Y-m-d", strtotime($row['created_at'])) ?></span>
                        <?php if ($row['is_secret']) { ?>
                            <span class="inquiry-secret"><i class="fas fa-lock"></i> 비밀글</span>
                        <?php } ?>
                    </div>
                </div>
                <div class="inquiry-post-content">
                    <?= nl2br($row['content']) ?>
                </div>
                
                <?php if (mysqli_num_rows($get_inquiry_images) > 0) { ?>
                <div class="inquiry-attachments">
                    <h3>첨부파일</h3>
                    <ul class="attachment-list">
                        <?php while ($row_images = mysqli_fetch_assoc($get_inquiry_images)) { ?>
                            <li>
                                <a href="<?= $row_images['image_url'] ?>" target="_blank" download>
                                    <i class="fas fa-paperclip"></i> <?= basename($row_images['image_url']) ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>

                <!-- 답변 영역 추가 -->
                <?php if ($row['inquiry_status'] == '답변 완료') { ?>
                <div class="inquiry-answer">
                    <div class="answer-header">
                        <h3><i class="fas fa-reply"></i> 답변</h3>
                        <div class="answer-meta">
                            <span class="answer-author">답변자: 관리자</span>
                            <span class="answer-date">답변일: <?= date("Y-m-d", strtotime($row['answer_at'])) ?></span>
                        </div>
                    </div>
                    <div class="answer-content">
                        <?= nl2br($row['answer']) ?>
                    </div>
                </div>
                <?php } else { ?>
                <div class="inquiry-no-answer">
                    <p><i class="fas fa-clock"></i> 답변 대기중입니다.</p>
                </div>
                <?php } ?>

                <div class="inquiry-actions">
                    <a href="inquiry_list.php" class="btn-list">목록으로</a>
                    <?php if (isset($_SESSION['id']) && $_SESSION['id'] == $row['user_id']) { ?>
                        <a href="inquiry-edit.php?id=<?= $row['id'] ?>" class="btn-edit">수정하기</a>
                        <a href="javascript:void(0);" onclick="confirmDelete(<?= $row['id'] ?>)" class="btn-delete">삭제하기</a>
                    <?php } ?>
                </div>

                <?php } else { ?>
                    <p>존재하지 않는 문의글입니다.</p>
                    <div class="inquiry-actions">
                        <a href="inquiry_list.php" class="btn-list">목록으로</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
    <script>
    function confirmDelete(inquiryId) {
        if (confirm('정말로 이 문의글을 삭제하시겠습니까?')) {
            window.location.href = 'queries/delete_inquiry.php?id=' + inquiryId;
        }
    }
    </script>
</body>
</html>