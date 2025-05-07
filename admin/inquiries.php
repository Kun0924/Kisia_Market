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
                <h1>문의사항 관리</h1>
            </header>
            <div class="content-wrapper">
                <div class="filters">
                    <select id="typeFilter">
                        <option value="전체">전체</option>
                        <option value="배송">배송</option>
                        <option value="상품">상품</option>
                        <option value="주문/결제">주문/결제</option>
                        <option value="반품/교환">반품/교환</option>
                        <option value="기타">기타</option>
                    </select>
                    <input type="text" placeholder="제목/내용 검색">
                    <button class="edit-btn">검색</button>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>문의유형</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>작성일</th>
                            <th>답변상태</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once '../mainmenu/common/db.php'; // mysqli 연결됨

                            $sql = " SELECT i.*, u.name AS user_name
                            FROM inquiry i
                            JOIN users u ON i.user_id = u.id
                            ORDER BY i.created_at DESC";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($inquiry = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $inquiry['id'] . "</td>";// 문의 사항 번호
                                    echo "<td>" . $inquiry['type'] . "</td>"; //문의 유형
                                    echo "<td>" . $inquiry['title'] . "</td>";
                                    echo "<td>" . $inquiry['user_name'] . "</td>";
                                    echo "<td>" . $inquiry['created_at'] . "</td>";
                                    echo "<td>-</td>"; // 문의 사항 상태
                                    echo "<td>
                                        <a href='admin_edit.php?id=" . $inquiry['id'] . "' class='edit-btn' title='문의답변'>
                                            <i class='fa fa-reply'></i>
                                        </a>
                                        <a href='admin_delete.php?id=" . $inquiry['id'] . "' class='delete-btn' title='삭제'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                      </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='no-data'>등록된 문의사항이 없습니다.</td></tr>";
                            }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('typeFilter').addEventListener('change', function () {
        const selectedType = this.value;
        const rows = document.querySelectorAll('table tbody tr');

        rows.forEach(row => {
            const typeCell = row.cells[1]; // 두 번째 열: 문의유형
            if (!typeCell) return;

            if (selectedType === '전체' || typeCell.textContent.trim() === selectedType) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    </script>

</body>
</html> 