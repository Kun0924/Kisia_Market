<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $sql = "SELECT * FROM products where category = '키보드' ORDER BY id DESC LIMIT 3";
    $get_keyboard_products = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM products where category = '마우스' ORDER BY id DESC LIMIT 3";
    $get_mouse_products = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM products where category = '마우스패드' ORDER BY id DESC LIMIT 3";
    $get_mousepad_products = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM products where category = '액세서리' ORDER BY id DESC LIMIT 3";
    $get_accessory_products = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
