<?php


session_start();

echo $_SESSION['id'];

// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


// mysqli connector
include_once '../../connector.php';

$mysqli = $conn;

$xmlFileName = "exported_data.xml";

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