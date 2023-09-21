<?php 

require '../vendor/autoload.php'; // Путь к файлу автозагрузки Composer
use PhpOffice\PhpWord\PhpWord;

$phpWord = new PhpWord();


try {
  $pdo = new PDO('mysql:host=localhost;dbname=savolho', 'root', '');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die('Подключение к базе данных не удалось: ' . $e->getMessage());
}

$table_name = "questions";

// Выполнение SQL-запроса для получения данных
$sql = "SELECT * FROM $table_name";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$section = $phpWord->addSection();
foreach ($data as $row) {
  $section->addText("Вопрос: " . $row['id']);
    $section->addText("Заголовок: " . $row['title']);
    $section->addText("Текст: " . $row['description']);
    $section->addText("Дата создания: " . $row['date_added']);
    // Добавьте другие поля по вашему усмотрению
    $section->addText("-----------------------"); // Разделитель между записями
}

$filename = 'output.docx';
$phpWord->save($filename);

?>