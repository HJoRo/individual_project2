<?php
$dsn = 'mysql:host=localhost;dbname=individual_project';
$username = 'root';
$password = 'tgX[hKxsQ6';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo 'An error occurred: ', $error_message;
    exit;
}

function display_db_error($error_message) {
    global $app_path;
    echo 'An error occurred: ', $error_message;
    exit;
}
?>