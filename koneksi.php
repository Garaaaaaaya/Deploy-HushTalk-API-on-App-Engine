<?php
$user       = getenv('CLOUDSQL_USER');
$database   = getenv('CLOUDSQL_DB');
$password   = getenv('CLOUDSQL_PASSWORD');
$instance   = getenv('CLOUDSQL_DSN');

// $connection = new mysqli(null,$user, $password, $database, null, $instance); 
$connection = mysqli_connect(null,$user, $password, $database, null, $instance); 

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

header('Content-Type: application/json');

?>
