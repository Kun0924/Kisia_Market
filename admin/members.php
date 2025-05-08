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
                <a href="members_add.php" class="add-product-btn">회원 추가</a>
            </header>
            <div class="content-wrapper">
                <div class="filters">
                    <input type="text" placeholder="회원명/아이디 검색">
                    <button>검색</button>
                </div>
                <table class="table">
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
                        <?php
                        require_once '../mainmenu/common/db.php'; // mysqli 연결됨
                        
                        $sql = "SELECT * FROM users ORDER BY id ASC";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($users = mysqli_fetch_assoc($result)) {
                                echo "<tr onclick=\"toggleDetail(" . $users['id'] . ")\" style=\"cursor: pointer;\">";
                                echo "<td>" . $users['id'] . "</td>";
                                echo "<td>" . $users['userId'] . "</td>";
                                echo "<td>" . $users['name'] . "</td>";
                                echo "<td>" . $users['email'] . "</td>";
                                echo "<td>" . date('Y-m-d', strtotime($users['created_at'])) . "</td>";
                                echo "<td>-</td>";
                                echo "<td>
                                        <a href='admin_delete.php?id=" . $users['id'] . "&type=users' class='delete-btn' title='삭제'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                    </td>";
                        
                                echo "</tr>";

                                // 상세 정보 추가
                                echo "<tr id='detail-" . $users['id'] . "' style='display: none; background-color: #f9f9f9;'>";
                                echo "<td colspan='7'>";
                                echo "<strong>아이디:</strong> " . $users['userId'] . "<br>";
                                echo "<strong>이름:</strong> " . $users['name'] . "<br>";
                                echo "<strong>이메일:</strong> " . $users['email'] . "<br>";
                                echo "<strong>전화번호:</strong> " . $users['phone'] . "<br>";
                                echo "<strong>가입일:</strong> " . $users['created_at'] . "<br>";
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
        const detailRow = document.getElementById('detail-' + id);
        if (detailRow) {
            detailRow.style.display = detailRow.style.display === 'none' ? '' : 'none';
        }
    }
    </script>

</body>
</html> 