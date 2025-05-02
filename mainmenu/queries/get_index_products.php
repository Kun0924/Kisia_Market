<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $sql = "SELECT * FROM products where category = 'keyboard' ORDER BY id DESC LIMIT 3";
    $get_keyboard_products = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM products where category = 'mouse' ORDER BY id DESC LIMIT 3";
    $get_mouse_products = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM products where category = 'mousepad' ORDER BY id DESC LIMIT 3";
    $get_mousepad_products = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM products where category = 'accessory' ORDER BY id DESC LIMIT 3";
    $get_accessory_products = mysqli_query($conn, $sql);

    mysqli_close($conn);
?>
