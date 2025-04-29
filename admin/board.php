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
            </header>
            <div class="content-wrapper">
                <div class="board-filters">
                    <select>
                        <option>전체 게시판</option>
                        <option>공지사항</option>
                        <option>Q&A</option>
                        <option>리뷰</option>
                    </select>
                    <input type="text" placeholder="제목/내용 검색">
                    <button>검색</button>
                </div>
                <table class="board-table">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>게시판</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일</th>
                            <th>조회수</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="no-data">등록된 게시글이 없습니다.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html> 