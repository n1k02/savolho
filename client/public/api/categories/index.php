<?php
include_once '../connector.php';

$tbname = "categories";

// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try {
    // Попытка подключения к базе данных
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // check method
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        //Логирование GET запросов
        file_put_contents('../log.txt', 'GET request (catergories): ' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);

        // Select request
        $sql = "SELECT * FROM " . $tbname;
        $result = $conn->query($sql);

        // Processing result and send to client
        if ($result->num_rows > 0) {
            $questions = array();
            while ($row = $result->fetch_assoc()) {
                $questions[] = $row;
            }
            echo json_encode($questions);
        } else {
            echo json_encode(array("message" => "Question not found"));
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Insert request
        $data = json_decode(file_get_contents("php://input"), true);
        $id = 'DEFAULT';
        $name = $data['name'];

        $sql = "INSERT INTO $tbname (name) VALUES ('$name')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Question created successfully"));
        } else {
            echo json_encode(array("error" => "Error when creating a question: " . $conn->error));
        }
    } else {
        http_response_code(405); // This method is not allowed 
        echo json_encode(array("error" => "This method is not allowed"));

        file_put_contents('../log.txt', 'Error: ' . date('Y-m-d H:i:s') . PHP_EOL, FILE_APPEND);

    }

    // Закрываем соединение с базой данных
    $conn->close();
} catch (Exception $e) {
    // Обработка ошибок подключения к базе данных
    http_response_code(500); // Внутренняя ошибка сервера
    echo json_encode(array("error" => $e->getMessage()));
}
?>
