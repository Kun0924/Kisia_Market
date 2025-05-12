<!-- orders.php -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>주문 관리 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<div class="admin-container">
    <?php include 'topbar.php'; ?>
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
                <tbody>
                    <?php
                    require_once '../mainmenu/common/db.php';

                    $sql = "SELECT o.id AS order_id, o.order_created_at, o.order_status, u.userId AS user_id,
                                   o.receiver_name, o.receiver_phone, o.receiver_address,
                                   o.payment_method, o.order_amount
                            FROM orders o
                            LEFT JOIN users u ON o.user_id = u.id
                            ORDER BY o.order_created_at DESC";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($order = mysqli_fetch_assoc($result)) {
                            echo "<tr class='order-row' data-id='" . $order['order_id'] . "' style='cursor:pointer;'>";
                            echo "<td><input type='checkbox'></td>";
                            echo "<td>" . date('Y-m-d', strtotime($order['order_created_at'])) . "</td>";
                            echo "<td>" . $order['order_id'] . "</td>";
                            echo "<td>" . $order['user_id'] . "</td>";
                            $status_html = '';
                            if ($order['order_status'] == 'pending') {
                                $status_html = '<span class="order-status status-pending">결제 대기</span>';
                            } elseif ($order['order_status'] == 'paid') {
                                $status_html = '<span class="order-status status-paid">결제 완료</span>';
                            } elseif ($order['order_status'] == 'cancelled') {
                                $status_html = '<span class="order-status status-cancelled">주문 취소</span>';
                            }
                            echo "<td>$status_html</td>";
                            echo "<td>";
                            if ($order['order_status'] == 'pending') {
                                echo "<button class='btn btn-success btn-sm confirm-payment' data-id='" . $order['order_id'] . "' title='결제 확인'>
                                        <i class='fas fa-check'></i> 결제 확인
                                    </button>";
                            } elseif ($order['order_status'] == 'paid') {
                                echo "<button class='btn btn-danger btn-sm cancel-payment' data-id='" . $order['order_id'] . "' title='결제 취소'>
                                        <i class='fas fa-times'></i> 결제 취소
                                    </button>";
                            }
                            echo "<a href='admin_delete.php?id=" . $order['order_id'] . "&type=orders' class='delete-btn' title='삭제'>
                                    <i class='fas fa-trash'></i>
                                </a>";
                            echo "</td>";
                            echo "</tr>";

                            echo "<tr id='detail-" . $order['order_id'] . "' class='order-detail' style='display: none; background-color: #f9f9f9;'>";
                            echo "<td colspan='6'>";
                            echo "<strong>수령인:</strong> " . $order['receiver_name'] . "<br>";
                            echo "<strong>전화번호:</strong> " . $order['receiver_phone'] . "<br>";
                            echo "<strong>배송지:</strong> " . $order['receiver_address'] . "<br>";
                            echo "<strong>결제방식:</strong> " . $order['payment_method'] . "<br>";
                            echo "<strong>주문금액:</strong> " . number_format($order['order_amount']) . "원<br>";
                            echo "</td>";
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.order-row').forEach(row => {
        row.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const detailRow = document.getElementById('detail-' + id);
            if (detailRow) {
                detailRow.style.display = (detailRow.style.display === 'none' || detailRow.style.display === '') ? 'table-row' : 'none';
            }
        });
    });
});
// 결제 확인 버튼 클릭 이벤트
document.querySelectorAll('.confirm-payment').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.dataset.id;
            if (confirm('이 주문의 결제를 확인하시겠습니까?')) {
                fetch('confirm_payment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `order_id=${orderId}&status=paid`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('결제 확인 중 오류가 발생했습니다.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('결제 확인 중 오류가 발생했습니다.');
                });
            }
        });
    });

// 결제 취소 버튼 클릭 이벤트
document.querySelectorAll('.cancel-payment').forEach(button => {
    button.addEventListener('click', function() {
        const orderId = this.dataset.id;
        if (confirm('이 주문의 결제를 취소하시겠습니까?')) {
            fetch('confirm_payment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `order_id=${orderId}&status=cancelled`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('결제 취소 중 오류가 발생했습니다.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('결제 취소 중 오류가 발생했습니다.');
            });
        }
    });
});
</script>
</body>
</html>
