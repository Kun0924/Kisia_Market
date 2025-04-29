<?php
$host = 'db';
$user = 'root';
$pass = 'root';
$dbname = 'kisia_market';

// DB 연결
$conn = mysqli_connect($host, $user, $pass, $dbname, 3306);

// 연결 실패 처리
if (!$conn) {
    die('DB 연결 실패: ' . mysqli_connect_error());
}
?>
