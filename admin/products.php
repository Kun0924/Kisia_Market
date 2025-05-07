<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품 관리 - KISIA SHOP</title>
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
                <h1>상품 관리</h1>
                <a href="products_add.php" class="add-product-btn">상품 추가</a>
            </header>
            <div class="content-wrapper">
                <div class="filters">
                    <select id="category-filter">
                        <option value="all">전체 카테고리</option>
                        <option value="accessory">액세서리</option>
                        <option value="keyboard">키보드</option>
                        <option value="mouse">마우스</option>
                        <option value="mousepad">마우스패드</option>
                    </select>
                    <input type="text" placeholder="상품명 검색">
                    <button>검색</button>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>상품 ID</th>
                            <th>상품명</th>
                            <th>카테고리</th>
                            <th>가격</th>
                            <th>재고</th>
                            <th>등록일</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../mainmenu/common/db.php'; // mysqli 연결됨

                        $sql = "SELECT * FROM products ORDER BY id asc";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($product = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $product['id'] . "</td>";
                                echo "<td>" . $product['name'] . "</td>";
                                echo "<td>" . $product['category'] . "</td>";
                                echo "<td>" . number_format($product['price']) . "원</td>";
                                echo "<td>" . $product['stock'] . "</td>";
                                echo "<td>" . date('Y-m-d', strtotime($product['created_at'])) . "</td>";
                                echo "<td>
                                        <a href='admin_edit.php?id=" . $product['id'] . "' class='edit-btn' title='확인 및 수정'>
                                            <i class='fas fa-edit'></i>
                                        </a>
                                        <a href='admin_delete.php?id=" . $product['id'] . "' class='delete-btn' title='삭제'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='no-data'>등록된 상품이 없습니다.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryFilter = document.getElementById('category-filter');
        const rows = document.querySelectorAll('tbody tr');

        categoryFilter.addEventListener('change', function () {
            const selectedCategory = this.value;

            rows.forEach(row => {
                const category = row.children[2].textContent.trim(); // 3번째 컬럼 = 카테고리

                if (selectedCategory === 'all' || category === selectedCategory) {
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
