<?php
$file = $_GET['file'] ?? '';

// php:// 등 우회 시도 차단
if (preg_match('/php:\/\/|filter|base64/i', $file)) {
    exit('허용되지 않는 요청입니다.');
}

$file = basename($file);
$path = "/var/www/html/inquiry_uploads/" . $file;

$base_dir = realpath("/var/www/html/inquiry_uploads");
$real_path = realpath($path);

// 경로 우회 방지: 파일의 실 경로가 기준 디렉터리 하위인지 확인
if ($real_path === false || strpos($real_path, $base_dir) !== 0) {
    exit("허용되지 않는 경로입니다.");
}

if (file_exists($real_path)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($real_path) . '"');
    header('Content-Length: ' . filesize($real_path));
    readfile($real_path);
    exit;
} else {
    echo $real_path;
    echo "File not found.";
}
?>
