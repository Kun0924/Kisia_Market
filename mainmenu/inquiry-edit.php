<?php include '/var/www/html/mainmenu/queries/get_header_session.php';?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1:1 문의 수정 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/inquiry-write.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <?php include 'common/header.php'; ?>
    <?php require_once 'queries/get_inquiry_detail.php';?>
    <?php $row = mysqli_fetch_assoc($get_inquiry);?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <h2 class="page-title">1:1 문의 수정</h2>
            <div class="inquiry-form">
                <form action="queries/update_inquiry.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="inquiry_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                    <div class="form-group">
                        <label for="category">문의 유형</label>
                        <select id="category" name="category" required>
                            <option value="">선택하세요</option>
                            <option value="주문/결제" <?php echo ($row['type'] == '주문/결제') ? 'selected' : ''; ?>>주문/결제</option>
                            <option value="배송" <?php echo ($row['type'] == '배송') ? 'selected' : ''; ?>>배송</option>
                            <option value="반품/교환" <?php echo ($row['type'] == '반품/교환') ? 'selected' : ''; ?>>반품/교환</option>
                            <option value="상품" <?php echo ($row['type'] == '상품') ? 'selected' : ''; ?>>상품</option>
                            <option value="기타" <?php echo ($row['type'] == '기타') ? 'selected' : ''; ?>>기타</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="title">제목</label>
                        <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="content">내용</label>
                        <textarea id="content" name="content" rows="10" required><?php echo $row['content']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <table class="file-table">
                            <tbody>
                                <?php
                                    while ($file = mysqli_fetch_assoc($get_inquiry_images)) {
                                        echo "<tr class='existing-file'>";
                                        echo "<th scope='row'>기존 첨부파일</th>";
                                        echo "<td>";
                                        echo "<div style='display: flex; align-items: center; gap: 10px;'>";
                                        echo "<a href='" . $file['image_url'] . "' target='_blank'>" . basename($file['image_url']) . "</a>";
                                        echo "<input type='checkbox' name='delete_files[]' value='" . $file['id'] . "' id='delete_" . $file['id'] . "'>";
                                        echo "<label for='delete_" . $file['id'] . "'>삭제</label>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                    <?php for ($i = 0; $i < 5 - mysqli_num_rows($get_inquiry_images); $i++) { ?>
                                    <tr>
                                        <th scope="row">새 첨부파일<?php echo $i + 1; ?></th>
                                        <td><input name="file[]" type="file" class="file-input"></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <div class="secret-option">
                            <input type="checkbox" id="isSecret" name="isSecret" <?php echo ($row['is_secret']) ? 'checked' : ''; ?>>
                            <label for="isSecret">비밀글</label>
                            <input type="password" id="secretPassword" name="secretPassword" 
                                   placeholder="비밀번호" 
                                   style="display: <?php echo ($row['is_secret']) ? 'inline-block' : 'none'; ?>;"
                                   <?php echo ($row['is_secret']) ? 'required' : ''; ?>>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">수정하기</button>
                        <a href="inquiry_detail.php?id=<?php echo $id; ?>" class="btn-cancel">취소</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
    <script>
        document.getElementById('isSecret').addEventListener('change', function() {
            const passwordInput = document.getElementById('secretPassword');
            if (this.checked) {
                passwordInput.style.display = 'inline-block';
                passwordInput.required = true;
            } else {
                passwordInput.style.display = 'none';
                passwordInput.required = false;
                passwordInput.value = '';
            }
        });
    </script>
</body>
</html>
