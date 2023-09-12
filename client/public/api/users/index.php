
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
    // Предполагаем, что у вас уже есть настройки подключения к базе данных и объект $conn

    // Название таблицы, из которой вы хотите извлечь данные
    $tbname = "users"; // Замените на имя вашей таблицы

    // SQL-запрос для извлечения данных из таблицы
    $sql = "SELECT * FROM " . $tbname;

    // Выполняем SQL-запрос
    $result = $conn->query($sql);

    // Обрабатываем результат и отправляем клиенту
    if ($result->num_rows > 0) {
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode($data);
    } else {
        echo json_encode(array("message" => "No data found"));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Хеширование пароля (важно для безопасности)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // SQL-запрос для вставки данных в базу данных
    $sql = "INSERT INTO users (name, email, password_hash) VALUES ('$name', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "Регистрация успешно завершена.";
    } else {
        echo "Ошибка при регистрации: " . $conn->error;
    }
} else {
    http_response_code(405); // This method is not allowed 
    echo json_encode(array("error" => "This method is not allowed"));
}

$conn->close();
?>
