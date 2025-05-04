<?php
require_once '../mainmenu/common/db.php';

$id = $_GET['id'] ?? 0;
$type = $_GET['type'] ?? '';

switch ($type) {
    case 'products' :
        $sql = "delete from products where id = $id"
        break;

    case 'users' :
        $sql = "delete from users where id = $id"
        break;
    

    case 'reviews' :
        $sql = "delete from reviews where id = $id"
        break;

    case 'inquiry' :
        $sql = "delete from inquiry where id = $id"
        break;
    
    case 'notices' :
        $sql = "delete from notices where id = $id"
        break;

}

$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>alert('삭제 성공!'); location.href=document.referrer;</script>";
} else {
    echo "<script>alert('삭제 실패: " . mysqli_error($conn) . "'); location.href=document.referrer;</script>";
}
