<?php
// 세션 시작 (필요시)
session_start();
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>주문 완료 - KISIA SHOP</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .order-complete-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
            text-align: center;
        }
        
        .order-complete-icon {
            font-size: 60px;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        
        .order-complete-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #333;
        }
        
        .order-complete-message {
            font-size: 16px;
            color: #666;
            margin-bottom: 30px;
        }
        
        .order-number {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 30px;
            font-size: 16px;
        }
        
        .order-number span {
            font-weight: 700;
            color: #ff6b6b;
        }
        
        .order-complete-actions {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        
        .btn-order-detail {
            padding: 12px 25px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .btn-order-detail:hover {
            background: #e9ecef;
        }
        
        .btn-continue-shopping {
            padding: 12px 25px;
            background: #ff6b6b;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-continue-shopping:hover {
            background: #ff5252;
        }
        
        @media (max-width: 768px) {
            .order-complete-actions {
                flex-direction: column;
            }
            
            .btn-order-detail,
            .btn-continue-shopping {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include 'common/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            <div class="order-complete-container">
                <div class="order-complete-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h2 class="order-complete-title">주문이 완료되었습니다</h2>
                <p class="order-complete-message">주문해 주셔서 감사합니다. 주문 내역은 아래에서 확인하실 수 있습니다.</p>
                
                <div class="order-number">
                    주문번호: <span>202304290001</span>
                </div>
                
                <div class="order-complete-actions">
                    <a href="order.php" class="btn-order-detail">주문 내역 확인</a>
                    <a href="all.php" class="btn-continue-shopping">쇼핑 계속하기</a>
                </div>
            </div>
        </div>
    </main>

    <?php include 'common/footer.php'; ?>
</body>
</html> 