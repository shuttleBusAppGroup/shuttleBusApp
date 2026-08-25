<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
mysqli_report(MYSQLI_REPORT_OFF);

$databaseConfig = [
    'host' => getenv('DB_HOST'),
    'port' => getenv('DB_PORT') ?: '3306',
    'name' => getenv('DB_NAME'),
    'user' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
];

foreach (['host', 'name', 'user'] as $requiredKey) {
    if ($databaseConfig[$requiredKey] === false || $databaseConfig[$requiredKey] === '') {
        error_log("Missing required database configuration: {$requiredKey}");
        http_response_code(500);
        exit('Database configuration is unavailable.');
    }
}

if ($databaseConfig['password'] === false || !ctype_digit($databaseConfig['port'])) {
    error_log('Database password or port is not configured.');
    http_response_code(500);
    exit('Database configuration is unavailable.');
}

$host = $databaseConfig['host'];
$user = $databaseConfig['user'];
$password = $databaseConfig['password'];
$database = $databaseConfig['name'];
$port = (int) $databaseConfig['port'];

$db_connection = new mysqli($host, $user, $password, $database, $port);

if ($db_connection->connect_errno) {
    error_log("Database connection failed with MySQL error code {$db_connection->connect_errno}.");
    http_response_code(500);
    exit('Database connection is unavailable.');
}

if (!$db_connection->set_charset('utf8mb4')) {
    error_log('Database connection could not use utf8mb4.');
    $db_connection->close();
    http_response_code(500);
    exit('Database connection is unavailable.');
}
