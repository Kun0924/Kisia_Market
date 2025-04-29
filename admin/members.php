<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원 관리 - KISIA SHOP</title>
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
                <h1>회원 관리</h1>
            </header>
            <div class="content-wrapper">
                <div class="member-filters">
                    <select>
                        <option>전체 회원</option>
                        <option>일반 회원</option>
                        <option>관리자</option>
                    </select>
                    <input type="text" placeholder="회원명/아이디 검색">
                    <button>검색</button>
                </div>
                <table class="member-table">
                    <thead>
                        <tr>
                            <th>회원 ID</th>
                            <th>아이디</th>
                            <th>이름</th>
                            <th>이메일</th>
                            <th>가입일</th>
                            <th>최근 접속</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="no-data">등록된 회원이 없습니다.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html> 