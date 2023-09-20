<?php


session_start();

echo $_SESSION['id'];

// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


// mysqli connector
include_once '../connector.php';

$mysqli = mysqli_connect("localhost", "root", "", "savolho");

$xmlFileName = "exported_data.xml";

// Создайте новый объект SimpleXMLElement для создания XML
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Data></Data>');

// Выполните SQL-запрос для извлечения данных
$query = "SELECT * FROM questions";
$result = $mysqli->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $questions = $xml->addChild('Question');
        $questions->addChild('id', $row['id']);
        $questions->addChild('title', $row['title']);
        $questions->addChild('description', $row['description']);
        $questions->addChild('author', $row['author']);
        $questions->addChild('categories', $row['categories']);
        $questions->addChild('data_added', $row['data_added']);
    }

    // Сохраните XML в файл
    $xml->asXML($xmlFileName);

    // Закройте соединение с базой данных
    $mysqli->close();

    echo "Данные успешно экспортированы в XML файл: $xmlFileName";
} else {
    echo "Ошибка при выполнении SQL-запроса: " . $mysqli->error;
}





?>