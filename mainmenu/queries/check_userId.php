<?php
    require_once '/var/www/html/mainmenu/common/db.php';

    $username = $_POST['username'];

    // $sql = "SELECT * FROM users WHERE userId = '$username'";
    // $result = mysqli_query($conn, $sql);

    // Prepared Statement 사용
    $stmt = $conn->prepare("SELECT * FROM users WHERE userId = ?");
    $stmt->bind_param("s", $username); // s: string
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }

    $stmt->close();

    mysqli_close($conn);
?>