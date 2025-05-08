<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리뷰 관리 - KISIA SHOP</title>
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
                <h1>리뷰 관리</h1>
            </header>
            <div class="content-wrapper">
                <div class="filters">
                    <select id="category-filter">
                        <option value="all">전체 카테고리</option>
                        <option value="keyboard">키보드</option>
                        <option value="mouse">마우스</option>
                        <option value="mousepad">마우스패드</option>
                        <option value="accessory">액세서리</option>
                    </select>

                    <input type="text" placeholder="">
                    <button>검색</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>상품카테고리</th>
                            <th>상품명</th>
                            <th>작성자</th>
                            <th>평점</th>
                            <th>작성일</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once '../mainmenu/common/db.php'; // mysqli 연결됨

                        $sql = "SELECT r.id, r.rating, r.content, r.image_url, r.created_at,
                                    u.name AS user_name, p.name AS product_name, p.category AS product_category
                                FROM reviews r
                                LEFT JOIN users u ON r.user_id = u.id
                                LEFT JOIN products p ON r.product_id = p.id
                                ORDER BY r.created_at ASC";
                        $result = mysqli_query($conn, $sql);

                        if ($result && $result->num_rows > 0) {
                            while ($reviews = $result->fetch_assoc()) {
                                echo "<tr class='review-row' data-id='" . $reviews['id'] . "'>";
                                echo "<td>" . $reviews['id'] . "</td>";
                                echo "<td>" . $reviews['product_category'] . "</td>";
                                echo "<td>" . $reviews['product_name'] . "</td>";
                                echo "<td>" . $reviews['user_name'] . "</td>";
                                echo "<td class='star-rating' data-rating='" . (int)$reviews['rating'] . "'>" . str_repeat('★', (int)$reviews['rating']) . "</td>";
                                echo "<td>" . $reviews['created_at'] . "</td>";
                                echo "<td>
                                       <a href='admin_delete.php?id=" . $reviews['id'] . "&type=reviews' class='delete-btn' title='삭제'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                      </td>";
                                echo "</tr>";
                                echo "<tr class='review-detail' id='detail-" . $reviews['id'] . "' style='display: none; background-color: #f9f9f9;'>";
                                echo "<td colspan='7'>";
                                echo "<strong>상품명:</strong> " . ($reviews['product_name'] ?? '알 수 없음') . "<br>";
                                echo "<strong>작성자:</strong> " . ($reviews['user_name'] ?? '알 수 없음') . "<br>";
                                echo "<strong>평점:</strong> " . (int)$reviews['rating'] . "점<br>";
                                echo "<strong>작성일:</strong> " . $reviews['created_at'] . "<br>";
                                echo "<strong>리뷰 내용:</strong><br>" . nl2br($reviews['content']) . "<br><br>";
                                echo "</td>";
                                echo "</tr>";
                                
                            }
                        } else {
                            echo "<tr><td colspan='7' class='no-data'>등록된 리뷰가 없습니다.</td></tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category-filter');
        const rows = document.querySelectorAll('tbody tr.review-row');

        categorySelect.addEventListener('change', function () {
            const selected = this.value;

            rows.forEach(row => {
                const id = row.getAttribute('data-id');
                const categoryCell = row.cells[1]?.textContent.trim(); // 카테고리

                const detailRow = document.getElementById('detail-' + id);

                if (selected === 'all' || categoryCell === selected) {
                    row.style.display = '';
                    if (detailRow) detailRow.style.display = 'none';
                } else {
                    row.style.display = 'none';
                    if (detailRow) detailRow.style.display = 'none';
                }
            });
        });

        // 상세 보기 토글
        document.querySelectorAll('.review-row').forEach(row => {
            row.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const detailRow = document.getElementById('detail-' + id);
                if (detailRow) {
                    detailRow.style.display = detailRow.style.display === 'none' ? '' : 'none';
                }
            });
        });
    });
    </script>

</body>
</html> 