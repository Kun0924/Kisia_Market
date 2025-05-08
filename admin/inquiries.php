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
                            require_once '../mainmenu/common/db.php';

                            $sql = "SELECT i.*, u.name AS user_name
                                    FROM inquiry i
                                    JOIN users u ON i.user_id = u.id
                                    ORDER BY i.created_at DESC";
                            $result = mysqli_query($conn, $sql);

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($inquiry = mysqli_fetch_assoc($result)) {
                                    echo "<tr onclick=\"toggleDetail(" . $inquiry['id'] . ")\" style=\"cursor: pointer;\">";
                                    echo "<td>" . $inquiry['id'] . "</td>";
                                    echo "<td>" . $inquiry['type'] . "</td>";
                                    echo "<td>" . $inquiry['title'] . "</td>";
                                    echo "<td>" . $inquiry['user_name'] . "</td>";
                                    echo "<td>" . $inquiry['created_at'] . "</td>";
                                    echo "<td>" . $inquiry['inquiry_status'] . "</td>";
                                    echo "<td>
                                            <a href='inquiries_answer.php?id=" . $inquiry['id'] . "' class='edit-btn' title='문의답변'>
                                                <i class='fa fa-reply'></i>
                                            </a>
                                            <a href='admin_delete.php?id=" . $inquiry['id'] . "&type=inquiry' class='delete-btn' title='삭제'>
                                                <i class='fas fa-trash'></i>
                                            </a>
                                          </td>";
                                    echo "</tr>";

                                    // 상세내용 행 추가
                                    echo "<tr id='detail-" . $inquiry['id'] . "' style='display: none; background-color: #f9f9f9;'>";
                                    echo "<td colspan='7'>";
                                    echo "<strong>문의 내용:</strong><br>" . nl2br($inquiry['content']) . "<br><br>";
                                    if (!empty($inquiry['answer'])) {
                                        echo "<strong>답변:</strong><br>" . nl2br($inquiry['answer']);
                                        echo "<form action='answer_delete.php' method='POST' style='margin-top:10px;'>
                                                <input type='hidden' name='inquiry_id' value='" . $inquiry['id'] . "'>
                                                <button type='submit' class='delete-btn' onclick=\"return confirm('정말 답변을 삭제하시겠습니까?');\">답변 삭제</button>
                                            </form>";
                                    } else {
                                        echo "<p style='color: red;'>아직 답변이 등록되지 않았습니다.</p>";
                                    }
                                    echo "</td>";
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
            const typeCell = row.cells[1];
            if (!typeCell || row.id.startsWith("detail-")) return;

            if (selectedType === '전체' || typeCell.textContent.trim() === selectedType) {
                row.style.display = '';
                const detailRow = document.getElementById('detail-' + row.cells[0].textContent);
                if (detailRow) detailRow.style.display = 'none'; // 필터시 상세 내용 숨기기
            } else {
                row.style.display = 'none';
                const detailRow = document.getElementById('detail-' + row.cells[0].textContent);
                if (detailRow) detailRow.style.display = 'none';
            }
        });
    });

    function toggleDetail(id) {
        const row = document.getElementById('detail-' + id);
        if (row) {
            row.style.display = row.style.display === 'none' ? '' : 'none';
        }
    }
    </script>
</body>
</html>
