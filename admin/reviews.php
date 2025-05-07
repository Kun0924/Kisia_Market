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
                    <select id="rating-filter">
                        <option value="all">전체 평점</option>
                        <option value="5">5점</option>
                        <option value="4">4점</option>
                        <option value="3">3점</option>
                        <option value="2">2점</option>
                        <option value="1">1점</option>
                    </select>
                    <input type="text" placeholder="검색어 입력">
                    <button>검색</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>번호</th>
                            <th>상품명</th>
                            <th>작성자</th>
                            <th>평점</th>
                            <th>내용</th>
                            <th>작성일</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        require_once '../mainmenu/common/db.php'; // mysqli 연결됨

                        $sql = "SELECT r.id, r.rating, r.content, r.image_url, r.created_at,
                                    u.name AS user_name, p.name AS product_name
                                FROM reviews r
                                LEFT JOIN users u ON r.user_id = u.id
                                LEFT JOIN products p ON r.product_id = p.id
                                ORDER BY r.created_at ASC";
                        $result = mysqli_query($conn, $sql);

                        if ($result && $result->num_rows > 0) {
                            while ($reviews = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $reviews['id'] . "</td>";
                                echo "<td>" . $reviews['product_name'] ?? '알 수 없음' . "</td>";
                                echo "<td>" . $reviews['user_name'] ?? '알 수 없음' . "</td>";
                                echo "<td class='star-rating' data-rating='" . (int)$reviews['rating'] . "'>" . str_repeat('★', (int)$reviews['rating']) . "</td>";
                                echo "<td>" . nl2br($reviews['content']) . "</td>";
                                echo "<td>" . $reviews['created_at'] . "</td>";
                                echo "<td>
                                        <a href='admin_delete.php?id=" . $reviews['id'] . "' class='delete-btn' title='삭제'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                      </td>";
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
        const ratingSelect = document.getElementById('rating-filter');
        const rows = document.querySelectorAll('tbody tr');

        ratingSelect.addEventListener('change', function () {
            const selectedRating = this.value;

            rows.forEach(row => {
                const ratingTd = row.querySelector('td[data-rating]');
                if (!ratingTd) return;

                const rowRating = ratingTd.getAttribute('data-rating');

                if (selectedRating === 'all' || rowRating === selectedRating) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
    </script>
</body>
</html> 