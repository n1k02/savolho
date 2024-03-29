<?php

// Set headers for CORS
header("Access-Control-Allow-Origin: *"); // Разрешить запросы с любого источника
header("Access-Control-Allow-Methods: POST, OPTIONS"); // Разрешить только POST и OPTIONS методы
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

session_start();

// Функция для записи сообщения в файл логов
function writeToLog($message) {
    $logFile = 'log.txt'; // Укажите путь к файлу логов
    error_log($message . "\n", 3, $logFile);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    http_response_code(200); // Устанавливаем HTTP статус 200 OK
    writeToLog("GET request received");
}

// mysqli connector
include_once '../../connector.php'; // ЭТО НАДО, ДЛЯ ПОДКЛЮЧЕНИЯ К БД

$tbname = "users";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $sql = "SELECT * FROM " . $tbname;

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Проверка существования пользователя с таким email в базе данных
            $stmt = $conn->prepare("SELECT id, name, password_hash FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                // Пользователь с таким email найден
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password_hash'];

                // Проверка пароля
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['user_id'] = $row['id']; // Сохраняем ID пользователя в сессии
                    $_SESSION['user_name'] = $row['name']; // Сохраняем имя пользователя в сессии
                    // Пароль верен
                    echo json_encode(array("message" => "Login successful", "user_id" => $row['id'], "user_name" => $row['name']));
                    writeToLog("Login successful for user: " . $row['name']);
                } else {
                    // Пароль неверен
                    echo json_encode(array("error" => "Incorrect password"));
                    writeToLog("Incorrect password for user: " . $row['name']);
                }
            } else {
                // Пользователь с таким email не найден
                echo json_encode(array("error" => "User not found"));
                writeToLog("User not found for email: $email");
            }

            $stmt->close();
        } else {
            echo json_encode(array("message" => "No data found"));
            writeToLog("No data found");
        }
    } catch ($e) {
        echo json_encode(array("error" => "An error occurred: " . $e->getMessage()));
        writeToLog("An error occurred: " . $e->getMessage());
    }
} else {
    http_response_code(405); // This method is not allowed
    echo json_encode(array("error" => "This method is not allowed"));
    writeToLog("Method not allowed");
}

$conn->close();
?>
