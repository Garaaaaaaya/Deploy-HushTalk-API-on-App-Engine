<?php
include 'koneksi.php';

function validateToken($connection, $token) {
    $sql = "SELECT * FROM user WHERE api_token='$token'";
    $result = $connection->query($sql);
    return $result->num_rows > 0;
}

$headers = getallheaders();
$authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';

if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    $token = $matches[1];

    if (validateToken($connection, $token)) {
        $sql = "SELECT * FROM mails";
        $result = $connection->query($sql);

        $mails = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $mails[] = $row;
            }
        }

        echo json_encode($mails);
    } else {
        echo json_encode(["error" => "Invalid token"]);
    }
} else {
    echo json_encode(["error" => "Authorization header not found"]);
}

$connection->close();
?>
