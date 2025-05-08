<?php
require_once '../mainmenu/common/db.php';

$id = $_GET['id'] ?? $_POST['id'] ?? 0;

// 답변 등록 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $answer = $_POST['answer'];

    $sql = "UPDATE inquiry SET answer = '$answer', inquiry_status = '답변 완료' WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('답변이 등록되었습니다.'); location.href='inquiries.php';</script>";
        exit;
    } else {
        echo "<script>alert('답변 등록 실패: " . mysqli_error($conn) . "');</script>";
    }
}

// 문의 내용 불러오기
$sql = "SELECT * FROM inquiry WHERE id = $id";
$result = mysqli_query($conn, $sql);
$inquiry = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>문의 답변 - 관리자</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        .admin-form {
            max-width: 700px;
            margin: 0 auto;
            padding: 24px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .admin-form .form-group {
            margin-bottom: 20px;
        }
        .admin-form label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-bottom: 6px;
        }
        .admin-form .form-text {
            background-color: #eee;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
        }
        .admin-form textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
        }
        .form-buttons {
            display: flex;
            justify-content: space-between;
            gap: 10px;
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
    </style>
</head>
<body>
<div class="admin-container">
    <?php include 'topbar.php'; ?>

    <div class="main-content">
        <header class="admin-header">
            <h1>문의 답변</h1>
        </header>

        <div class="content-wrapper">
            <form class="admin-form" method="post" action="">
                <input type="hidden" name="id" value="<?= $inquiry['id'] ?>">

                <div class="form-group">
                    <label>제목</label>
                    <div class="form-text"><?= $inquiry['title'] ?></div>
                </div>

                <div class="form-group">
                    <label>문의 내용</label>
                    <div class="form-text" style="min-height: 80px;"><?= nl2br($inquiry['content']) ?></div>
                </div>

                <div class="form-group">
                    <label for="answer">답변 작성</label>
                    <textarea name="answer" id="answer" rows="6" required><?= $inquiry['answer'] ?? '' ?></textarea>
                </div>

                <div class="form-buttons">
                    <button type="button" class="cancel-btn" onclick="history.back()">취소</button>
                    <?php $is_edit = !empty($inquiry['answer']); ?>
                    <button type="submit" class="submit-btn"><?= $is_edit ? '답변 수정' : '답변 등록' ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
