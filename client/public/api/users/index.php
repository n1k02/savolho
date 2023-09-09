
<!-- НУРИК ЭТО ТВОЯ РАБОТА -->

<?php


// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

// mysqli connector
include_once '../connector.php'; // ЭТО НАДО, ДЛЯ ПОДКЛЮЧЕНИЯ К БД

$tbname = "users";


// check method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // ГЕТ ЗАПРОС
    // ТУТ КРЧ НЕ ЗНАЮ, ПРОВЕРКА ПО ЛОГИНУ И ПАРОЛЮ ВРОДЕ ТОЖЕ ЗДЕСЬ ДЕЛАЕТСЯ 

    // SQL ЗАПРОС
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
    // ПОСТ ЗАПРОС
    
    $data = $_POST; // МАССИВ ДАННЫХ КОТОРЫЕ ТЫ ЧЕРЕЗ АХИОС ОТПРАВЛЯЕШЬ

    $title = $data['title'];
    $description = $data['description'];

    

    // SQL ЗАПРОС, СВОИ ДАННЫЕ ПОСТАВИШЬ
    $sql = "INSERT INTO $tbname (title, `description`)
            VALUES ('$title', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Question created successfully"));
    } else {
        echo json_encode(array("error" => "Error when creating a question: " . $conn->error));
    }
} else {
    http_response_code(405); // This method is not allowed 
    echo json_encode(array("error" => "This method is not allowed"));
}

$conn->close();
?>
