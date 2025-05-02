<?php
$menu_path = './';
$current_path = '../';
include 'queries/get_header_session.php';

$category = $_GET['category'] ?? 'keyboard'; // 기본값
$product_id = $_GET['id'] ?? null;

switch ($category) {
    case 'accessory':
        require_once 'queries/get_accessory_products.php';
        $get_products = $get_accessory_products;
        $page_title = 'KISIA SHOP - 액세서리 상세';
        break;
    case 'mouse':
        require_once 'queries/get_mouse_products.php';
        $get_products = $get_mouse_products;
        $page_title = 'KISIA SHOP - 마우스 상세';
        break;
    case 'mousepad':
        require_once 'queries/get_mousepad_products.php';
        $get_products = $get_mousepad_products;
        $page_title = 'KISIA SHOP - 마우스패드 상세';
        break;
    case 'keyboard':
    default:
        require_once 'queries/get_keyboard_products.php';
        $get_products = $get_keyboard_products;
        $page_title = 'KISIA SHOP - 키보드 상세';
        break;
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/product_explain.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<?php include 'common/header.php'; ?>

<main class="main-content">
    <div class="container">
        <?php
        if ($product_id && mysqli_num_rows($get_products) > 0) {
            while ($row = mysqli_fetch_assoc($get_products)) {
                if ($row['id'] == $product_id) {
                    echo '<div class="product-detail">';
                    echo '<div class="product-image">';
                    echo '<img src="../' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '">';
                    echo '</div>';
                    echo '<div class="product-info">';
                    echo '<h1>' . htmlspecialchars($row['name']) . '</h1>';
                    echo '<p class="price">' . number_format($row['price']) . '원</p>';
                    echo '<div class="button-group">';
                    echo '<button class="cart-btn"><i class="fas fa-shopping-cart"></i> 장바구니</button>';
                    echo '<button class="buy-btn">구매하기</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

                    echo '<div class="tabs">';
                    echo '<button class="tab-btn active" onclick="openTab(\'description\', this)">상품 설명</button>';
                    echo '<button class="tab-btn" onclick="openTab(\'reviews\', this)">리뷰</button>';
                    echo '</div>';

                    echo '<div id="description" class="tab-content active">';
                    echo '<h2>상품 설명</h2>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '</div>';

                    echo '<div id="reviews" class="tab-content">';
                    echo '<h2>리뷰</h2>';
                    include 'review_form.php';
                    echo '</div>';
                    break;
                }
            }
        }
        ?>
    </div>
</main>

<?php include 'common/footer.php'; ?>
</body>
</html>
