<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 관리 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>

        <!-- 메인 콘텐츠 -->
        <div class="main-content">
            <header class="admin-header">
                <h1>게시판 관리</h1>
                <button class="add-product-btn">공지사항 글쓰기</button>
                <button class="add-product-btn"></button>
            </header>
            <div class="content-wrapper">
                <div class="board-filters">
                    <input type="text" placeholder="제목/내용 검색">
                    <button>검색</button>
                </div>
                <table class="board-table">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일</th>
                            <th>조회수</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once '../mainmenu/common/db.php'; // mysqli 연결됨

                            $sql = "SELECT * FROM inquiry ORDER BY created_at DESC";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($inquiry = mysqli_fetch_assoc($result)) {
                                    $title = $inquiry['is_secret'] ? '🔒 비밀글입니다' : $inquiry['title'];
                                    echo "<tr>";
                                    echo "<td></td>";
                                    echo "<td>{$title}</td>";
                                    echo "<td>" . $inquiry['user_id'] . "</td>";
                                    echo "<td>" . $inquiry['created_at'] . "</td>";
                                    echo "<td>-</td>";
                                    echo "<td>
                                            <a href = 'admin_edit.php? id=" . $inquiry['id'] . "'title = '확인및수정'>
                                            <button class='edit-btn' data-id='" . $inquiry['id'] . "'><i class='fas fa-edit'></i></button>
                                            <a href = 'admin_delete.php? id=" . $inquiry['id'] . "'title = '삭제'>
                                            <button class='delete-btn' data-id='" . $inquiry['id'] . "'><i class='fas fa-trash'></i></button>
                                        </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='no-data'>등록된 문의사항이이 없습니다.</td></tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html> 