<?php
include 'koneksi.php';

function authenticate() {
    $headers = apache_request_headers();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized"]);
        exit();
    }

    $authHeader = $headers['Authorization'];
    list($type, $token) = explode(' ', $authHeader);

    if ($type !== 'Bearer') {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized"]);
        exit();
    }

    global $connection;
    $stmt = $connection->prepare("SELECT id FROM api_keys WHERE api_key = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        http_response_code(401);
        echo json_encode(["error" => "Unauthorized"]);
        exit();
    }

    $stmt->close();
}
?>
