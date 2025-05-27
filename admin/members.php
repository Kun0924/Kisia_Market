<?php
require_once 'admin_check.php';
require_once '../mainmenu/common/db.php';

$search_query = $_GET['search_query'] ?? '';
?>
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
        <?php include 'topbar.php'; ?>

        <!-- 메인 콘텐츠 -->
        <div class="main-content">
            <header class="admin-header">
                <h1>회원 관리</h1>
                <a href="members_add.php" class="add-product-btn">회원 추가</a>
            </header>
            <div class="content-wrapper">
                <div class="filters">
                    <form method="GET" action="">
                        <input type="text" name="search_query" placeholder="회원명/아이디 검색" value="<?= $_GET['search_query'] ?? '' ?>">
                        <button type="submit">검색</button>
                    </form>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>회원 ID</th>
                            <th>아이디</th>
                            <th>이름</th>
                            <th>이메일</th>
                            <th>가입일</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($search_query !== '') {
                            $sql = "SELECT * FROM users WHERE name LIKE ? OR userId LIKE ? ORDER BY id ASC";
                            $stmt = mysqli_prepare($conn, $sql);
                            $param = '%' . $search_query . '%';
                            mysqli_stmt_bind_param($stmt, 'ss', $param, $param);
                            mysqli_stmt_excute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                        } else {
                            $sql = "SELECT * FROM users ORDER BY id ASC";
                            $result = mysqli_query($conn, $sql);
                        }

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($users = mysqli_fetch_assoc($result)) {
                                echo "<tr onclick=\"toggleDetail(" . htmlspecialchars($users['id']) . ")\" style=\"cursor: pointer;\">";
                                echo "<td>" . htmlspecialchars($users['id']) . "</td>"; // 회원 ID
                                echo "<td>" . htmlspecialchars($users['userId']) . "</td>"; // 아이디
                                echo "<td>" . htmlspecialchars($users['name']) . "</td>"; // 이름
                                echo "<td>" . htmlspecialchars($users['email']) . "</td>"; // 이메일
                                echo "<td>" . htmlspecialchars(date('Y-m-d', strtotime($users['created_at']))) . "</td>"; // 가입일

                                echo "<td>";
                                if ($users['userId'] !== 'admin') {
                                    echo "<a href='admin_delete.php?id=" . urlencode($users['id']) . "&type=users' class='delete-btn' title='삭제'>
                                            <i class='fas fa-trash'></i>
                                        </a>";
                                }
                                echo "</td>";

                                echo "</tr>";


                                // 상세 정보 추가
                                echo "<tr id='user_detail-" . htmlspecialchars($users['id']) . "' class='user-detail'>";
                                echo "<td colspan='7'>";
                                echo "<strong>아이디:</strong> " . htmlspecialchars($users['userId']) . "<br>";
                                echo "<strong>이름:</strong> " . htmlspecialchars($users['name']) . "<br>";
                                echo "<strong>이메일:</strong> " . htmlspecialchars($users['email']) . "<br>";
                                echo "<strong>전화번호:</strong> " . htmlspecialchars($users['phone']) . "<br>";
                                echo "<strong>가입일:</strong> " . htmlspecialchars($users['created_at']) . "<br>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='no-data'>등록된 회원이 없습니다.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
    function toggleDetail(id) {
        const detailRow = document.getElementById('user_detail-' + id);
        if (detailRow) {
            detailRow.style.display = (detailRow.style.display === 'none' || detailRow.style.display === '') ? 'table-row' : 'none';
        }
    }
    </script>

</body>
</html> 