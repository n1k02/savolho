
<?php
// db connector
$server_name = "localhost";
$username = "root";
$password = "";
$dbname = "savolho"; 
$tbname = "questions";

$conn = new mysqli($server_name, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Db connection error: " . $conn->connect_error);
}

// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// check method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

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
    $title = $data['title'];
    $description = $data['description'];
    $author = $data['author'];
    $category = $data['category'];
    $date_added = $data['date_added'];
    $likes = $data['likes'];
    $image_url = $data['image_url'];

    $sql = "INSERT INTO $tbname (id, title, description, author, category, date_added, likes, image_url)
            VALUES ('$id', '$title', '$description', '$author', '$category', '$date_added', '$likes', '$image_url')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Question created successfully"));
    } else {
        echo json_encode(array("error" => "Error when creating a question: " . $conn->error));
    }
} 
// elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
//     // Update request
//     $data = json_decode(file_get_contents("php://input"), true);
//     $questionId = $data['id'];
//     $newField1 = $data['field1'];
//     $newField2 = $data['field2'];
//     $newField3 = $data['field3'];
//     $newField4 = $data['field4'];
//     $newField5 = $data['field5'];
//     $newField6 = $data['field6'];
//     $newField7 = $data['field7'];
//     $newField8 = $data['field8'];

//     $sql = "UPDATE $tbname 
//             SET field1 = '$newField1', field2 = '$newField2', field3 = '$newField3', field4 = '$newField4',
//                 field5 = '$newField5', field6 = '$newField6', field7 = '$newField7', field8 = '$newField8'
//             WHERE id = $questionId";
    
//     if ($conn->query($sql) === TRUE) {
//         echo json_encode(array("message" => "Вопрос успешно обновлен"));
//     } else {
//         echo json_encode(array("error" => "Ошибка при обновлении вопроса: " . $conn->error));
//     }
// } 
elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Delete request
    $data = json_decode(file_get_contents("php://input"), true);
    $questionId = $data['id'];

    $sql = "DELETE FROM $tbname WHERE id = $questionId";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "The question was successfully deleted"));
    } else {
        echo json_encode(array("error" => "Error when deleting the question: " . $conn->error));
    }
} else {
    http_response_code(405); // This method is not allowed 
    echo json_encode(array("error" => "This method is not allowed"));
}

$conn->close();
?>
