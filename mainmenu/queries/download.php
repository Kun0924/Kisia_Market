<?php
$file = $_GET['file'] ?? '';
$file = basename($file); // 디렉터리 트래버설 방지
$path = "/root/Kisia_Market/" . $file;

if(file_exists($path)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($path) . '"');
    header('Content-Length: ' . filesize($path));
    readfile($path);
    exit;
} else {
    echo "File not found.";
}
?>
