
<?php

$dbHost = getenv('DB_HOST') ?: 'localhost';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPassword = getenv('DB_PASSWORD');
$dbPassword = $dbPassword === false ? '' : $dbPassword;
$dbName = getenv('DB_NAME') ?: 'attendance';
$dbPort = getenv('DB_PORT');
$dbPort = $dbPort === false || $dbPort === '' ? 3306 : (int) $dbPort;

try {
    $con = new mysqli($dbHost, $dbUser, $dbPassword, $dbName, $dbPort);
    $con->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log('Database connection failed: ' . $exception->getMessage());
    http_response_code(500);
    die('Database connection failed.');
}
