<?php
// MySQL 연결 정보
$host = getenv('MYSQL_HOST');  // db 서비스 이름
$dbname = getenv('MYSQL_DATABASE');
$user = getenv('MYSQL_USER');
$pass = getenv('MYSQL_PASSWORD');

// PDO로 MySQL 연결
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "DB 연결 성공!";
} catch (PDOException $e) {
    die("DB 연결 실패: " . $e->getMessage());
}
?>
