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
        <?php include 'topbar.php'; ?>

        <!-- 메인 콘텐츠 -->
        <div class="main-content">
            <header class="admin-header">
                <h1>공지사항 관리</h1>
                <a href="notices_add.php" class="add-product-btn">공지사항 글쓰기</a>
            </header>
            <div class="content-wrapper">
                <div class="filters">
                    <input type="text" placeholder="제목/내용 검색">
                    <button>검색</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once '../mainmenu/common/db.php'; // mysqli 연결됨

                            $sql = "SELECT * FROM notices ORDER BY created_at DESC";
                            $result = mysqli_query($conn, $sql);

                            //공지사항
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($notices = mysqli_fetch_assoc($result)) {
                                    echo "<tr class='notice-row' data-id='" . $notices['id'] . "'>";
                                    echo "<td>" . $notices['id'] . "</td>";
                                    echo "<td>" . $notices['title'] . "</td>";
                                    echo "<td>관리자</td>";
                                    echo "<td>" . $notices['created_at'] . "</td>";
                                    echo "<td>
                                        <a href='notices_edit.php?id=" . $notices['id'] . "' class='edit-btn' title='게시글 수정'>
                                            <i class='fas fa-edit'></i>
                                        </a>
                                        <a href='admin_delete.php?id=" . $notices['id'] . "&type=notices' class='delete-btn' title='삭제'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                      </td>";
                                    echo "</tr>";
                                    echo "<tr id='notice_detail-" . $notices['id'] . "' class='notice-detail'>";
                                    echo "<td colspan='5'>";
                                    echo "<strong>공지 내용:</strong><br>" . nl2br($notices['content']) . "<br>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='no-data'>등록된 공지사항이 없습니다.</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.notice-row').forEach(row => {
            row.addEventListener('click', function (e) {
                if (e.target.closest('a')) return; // 수정/삭제 버튼 클릭 시 무시

                const id = this.getAttribute('data-id');
                const detailRow = document.getElementById('notice_detail-' + id);
                if (detailRow) {
                    detailRow.style.display = (detailRow.style.display === 'none' || detailRow.style.display === '') ? 'table-row' : 'none';
                }
            });
        });
    });
    </script>


</body>
</html> 