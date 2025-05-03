<?php include '/var/www/html/mainmenu/queries/get_header_session.php'; ?>
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
                <form action="queries/insert_inquiry.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                        <table class="file-table">
                            <tbody>
                                <tr>
                                    <th scope="row">첨부파일1</th>
                                    <td><input name="file[]" id="file1" type="file" class="file-input"></td>
                                </tr>
                                <tr>
                                    <th scope="row">첨부파일2</th>
                                    <td><input name="file[]" id="file2" type="file" class="file-input"></td>
                                </tr>
                                <tr>
                                    <th scope="row">첨부파일3</th>
                                    <td><input name="file[]" id="file3" type="file" class="file-input"></td>
                                </tr>
                                <tr>
                                    <th scope="row">첨부파일4</th>
                                    <td><input name="file[]" id="file4" type="file" class="file-input"></td>
                                </tr>
                                <tr>
                                    <th scope="row">첨부파일5</th>
                                    <td><input name="file[]" id="file5" type="file" class="file-input"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <div class="secret-option">
                            <input type="checkbox" id="isSecret" name="isSecret">
                            <label for="isSecret">비밀글</label>
                            <input type="password" id="secretPassword" name="secretPassword" placeholder="비밀번호" style="display: none;">
                        </div>
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
    <script>
        document.getElementById('isSecret').addEventListener('change', function() {
            const passwordInput = document.getElementById('secretPassword');
            if (this.checked) {
                passwordInput.style.display = 'inline-block';
                passwordInput.required = true;
            } else {
                passwordInput.style.display = 'none';
                passwordInput.required = false;
            }
        });
    </script>
</body>
</html> 