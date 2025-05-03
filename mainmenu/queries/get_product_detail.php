<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM products WHERE id = $id";
    $get_product_detail = mysqli_query($conn, $sql);

    $sql = "SELECT reviews.id, reviews.user_id, reviews.product_id, reviews.content, reviews.rating, reviews.image_url, reviews.created_at, users.name FROM reviews INNER JOIN users ON reviews.user_id = users.id WHERE reviews.product_id = $id";
    $get_reviews = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
