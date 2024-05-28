<?php
include 'auth.php';
include 'koneksi.php';

// Fungsi untuk memvalidasi token
function validateToken($connection, $token) {
    $sql = "SELECT * FROM user WHERE api_token='$token'";
    $result = $connection->query($sql);
    return $result->num_rows > 0;
}

// Mendapatkan input dari request
parse_str(file_get_contents('php://input'), $value);

// Mendapatkan header untuk otorisasi
$headers = getallheaders();
$authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';

if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    $token = $matches[1];

    // Validasi token
    if (validateToken($connection, $token)) {
        $sender = $value['sender'];
        $receiver = $value['receiver'];
        $subject = $value['subject'];
        $message = $value['message'];
        $date_mails = $value['date_mails'];

        $sql = "INSERT INTO mails (sender, receiver, subject, message, date_mails) VALUES ('$sender', '$receiver', '$subject', '$message', '$date_mails')";

        if ($connection->query($sql) === TRUE) {
            echo json_encode(["message" => "Mail created successfully"]);
        } else {
            echo json_encode(["error" => "Error: " . $sql . "<br>" . $connection->error]);
        }
    } else {
        echo json_encode(["error" => "Invalid token"]);
    }
} else {
    echo json_encode(["error" => "Authorization header not found"]);
}

$connection->close();
?>
