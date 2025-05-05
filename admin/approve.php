<!-- approve_order.php -->
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
    <div class="main-content">
        <header class="admin-header">
            <h1>주문 리스트</h1>
        </header>

        <div class="content-wrapper">

            <!-- 날짜 필터 -->
            <div class="order-filters">
                <label for="date-range">날짜</label>
                <input type="date" id="date-from">
                    <span>~</span>
                <input type="date" id="date-to">
            </div>

            <!-- 상태 필터 -->
            <!-- 상태 필터 목록 -->
            <ul class="order-status-list">
                <li class="status-item active" data-status="all">전체</li>
                <li class="status-item" data-status="waiting">승인 대기</li>
                <li class="status-item" data-status="complete">승인 완료</li>
                <li class="status-item" data-status="reject">승인 반려</li>
            </ul>


            <!-- 주문 테이블 -->
            <table class="order-table">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>접수일자</th>
                        <th>주문번호</th>
                        <th>아이디</th>
                        <th>이름</th>
                        <th>제품명</th>
                        <th>상태</th>
                    </tr>
                </thead>
                <tbody id="order-table-body">
                    <!--테이블 연동할 부분 아래는 임시 데이터 지워도 됩니다.-->
                    <tr data-status = 'waiting'> 
                        <td><input type="checkbox"></td>
                        <td>2020-05-22 (금) 09:50</td>
                        <td>196688</td>
                        <td>user</td>
                        <td>홍길동</td>
                        <td>프로그래밍 입문서</td>
                        <td><span class="badge waiting">승인대기</span></td> 
                    </tr>
                    <tr data-status = 'complete'>
                        <td><input type="checkbox"></td>
                        <td>2020-05-23 (토) 10:20</td>
                        <td>196689</td>
                        <td>admin</td>
                        <td>김영희</td>
                        <td>HTML 마스터북</td>
                        <td><span class="badge approved">승인완료</span></td>
                    </tr>
                    <tr data-status = 'reject'>
                        <td><input type="checkbox"></td>
                        <td>2020-05-24 (일) 12:05</td>
                        <td>196690</td>
                        <td>guest</td>
                        <td>이철수</td>
                        <td>웹 디자인 가이드</td>
                        <td><span class="badge rejected">승인반려</span></td>
                    </tr>
                </tbody>
            </table>

            <!-- 처리 버튼 -->
            <div class="order-action-buttons">
                <button class="reject-btn">주문반려</button>
                <button class="approve-btn">주문승인</button>
            </div>

            <!-- 페이지네이션 -->
            <div class="pagination">
                <button disabled>&laquo;</button>
                <button class="active">1</button>
                <button>&raquo;</button>
            </div>

        </div>
    </div>
</div>
<script>
document.querySelectorAll('.status-item').forEach(item => {
    item.addEventListener('click', () => {
        // 모든 항목 active 제거
        document.querySelectorAll('.status-item').forEach(el => el.classList.remove('active'));
        // 현재 항목 active 추가
        item.classList.add('active');

        const selectedStatus = item.dataset.status;
        const rows = document.querySelectorAll('#order-table-body tr');

        rows.forEach(row => {
            const rowStatus = row.dataset.status;
            if (selectedStatus === 'all' || rowStatus === selectedStatus) {
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
