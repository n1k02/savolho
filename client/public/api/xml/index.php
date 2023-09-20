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
        $questions->addChild('date_added', $row['date_added']);
    }


    $xml->asXML($xmlFileName);


    

    echo "Данные успешно экспортированы в XML файл: $xmlFileName";
} else {
    echo "Ошибка при выполнении SQL-запроса: " . $mysqli->error;
}

$xmlFilesName = "import_data.xml";
$xml = simplexml_load_file($xmlFilesName);

if ($xml === false) {
    die("Ошибка чтения XML-файла.");
}

foreach ($xml->children() as $questions) {
    $id = $questions->id;
    $title = $questions->title;
    $description = $questions->description;
    $author = $questions->author;
    $categories = $questions->categories;
    $date_added = $questions->date_added;

    if ($data_added === '') {
        $data_added = null; // Установка значения в NULL
    }
    // Выполните SQL-запрос для вставки данных в таблицу
    $query = "INSERT INTO questions (id, title, description, author, categories, date_added) VALUES ('$id', '$title', '$description', '$author', '$categories', '$date_added')";
    
    if ($mysqli->query($query) === TRUE) {
        echo "Данные успешно импортированы.";
    } else {
        echo "Ошибка при импорте данных: " . $mysqli->error;
    }
}





?>