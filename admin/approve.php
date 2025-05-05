<!-- approve_order.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>주문 관리 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <?php include 'sidebar.php'; ?>
        <div class="main-content">
            <header class="admin-header">
                <h1>주문 리스트</h1>
            </header>

            <div class="content-wrapper">
                <div class="filters">
                    <label for="date-from">날짜</label>
                    <input type="date" id="date-from">
                    <span>~</span>
                    <input type="date" id="date-to">
                    <input type="text" placeholder="주문번호/사용자ID 검색">
                    <button>검색</button>
                </div>

                <!-- 주문 테이블 -->
                <table class="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>접수일자</th>
                            <th>주문번호</th>
                            <th>사용자ID</th>
                            <th>주문 결제 상태</th>
                            <th>관리</th>
                        </tr>
                    </thead>
                    <tbody id="order-table-body">
                        <?php
                        require_once '../mainmenu/common/db.php'; // mysqli 연결됨

                        $sql = "SELECT o.id AS order_id, o.order_created_at, o.order_status, u.userId AS user_id, u.name AS user_name
                                FROM orders o
                                JOIN users u ON o.user_id = u.id
                                ORDER BY o.order_created_at DESC";
                        $result = mysqli_query($conn, $sql);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($orders = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td><input type='checkbox'></td>";
                                echo "<td>" . date('Y-m-d', strtotime($orders['order_created_at'])) . "</td>";
                                echo "<td>" . $orders['order_id'] . "</td>";
                                echo "<td>" . $orders['user_id'] . "</td>";
                                echo "<td>" . $orders['order_status'] . "</td>";
                                echo "<td>
                                        <a href='admin_edit.php?id=" . $orders['order_id'] . "' class='edit-btn' title='확인 및 수정'>
                                            <i class='fas fa-edit'></i>
                                        </a>
                                        <a href='admin_delete.php?id=" . $orders['order_id'] . "' class='delete-btn' title='삭제'>
                                            <i class='fas fa-trash'></i>
                                        </a>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='no-data'>등록된 주문이 없습니다.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
