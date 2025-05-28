<?php
$host = getenv('DB_HOST') ?? 'localhost';
$user = getenv('DB_USER') ?? 'root';
$pass = getenv('DB_PASS') ?? '';
$dbname = getenv('DB_NAME') ?? '';
$port = getenv('DB_PORT') ?? 3306;

// DB 연결
$conn = mysqli_connect($host, $user, $pass, $dbname, $port);

if (!$conn) {
    die("DB 연결 실패: " . mysqli_connect_error());
}
?>
