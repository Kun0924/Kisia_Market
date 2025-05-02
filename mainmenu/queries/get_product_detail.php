<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM products WHERE id = $id";
    $get_product_detail = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
