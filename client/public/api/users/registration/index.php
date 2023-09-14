<?php

// Set headers for CORS
header("Access-Control-Allow-Origin: *"); // Разрешить запросы с любого источника
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Разрешить только POST и OPTIONS методы
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// mysqli connector
include_once '../../connector.php'; // ЭТО НАДО, ДЛЯ ПОДКЛЮЧЕНИЯ К БД

$tbname = "users";

// check method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Хеширование пароля (важно для безопасности)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL-запрос для вставки данных в базу данных
        $sql = "INSERT INTO users (`name`, email, password_hash) VALUES ('$name', '$email', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "User created"));
        } else {
            echo json_encode(array("error" => "Registration error" . $conn->error));
        }
    } catch (Exception $e) {
        echo json_encode(array("error" => "An error occurred: " . $e->getMessage()));
    }
} else {
    http_response_code(405); // This method is not allowed
    echo json_encode(array("error" => "This method is not allowed"));
}

$conn->close();
?>
