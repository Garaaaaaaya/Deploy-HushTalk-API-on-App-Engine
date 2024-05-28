<?php
include 'koneksi.php';

function validateToken($connection, $token) {
    $sql = "SELECT * FROM user WHERE api_token='$token'";
    $result = $connection->query($sql);
    return $result->num_rows > 0;
}

// Mendapatkan header Authorization
$headers = getallheaders();
$authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';

if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    $token = $matches[1];

    if (validateToken($connection, $token)) {
        // Mendapatkan input dari request
        parse_str(file_get_contents('php://input'), $value);

        // Validasi input
        if (!isset($value['id_mails'])) {
            echo json_encode(["error" => "ID email tidak ditemukan."]);
            exit;
        }

        $id_mails = intval($value['id_mails']); // Pastikan ID adalah integer

        $sql = "DELETE FROM mails WHERE id_mails=$id_mails";

        if ($connection->query($sql) === TRUE) {
            echo json_encode(["message" => "Mail deleted successfully"]);
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
