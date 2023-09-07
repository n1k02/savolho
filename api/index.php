
<?php


// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

include_once './connector.php';

$tbname = "questions";


if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

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
    $categories = $data['categories'];
    $date_added = $data['date_added'];
    $likes = $data['likes'];
    $image_url = $data['image_url'];

    $sql = "INSERT INTO $tbname (title, `description`, author, categories, image_url)
            VALUES ('$title', '$description', '$author', '$categories', '$image_url')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Question created successfully"));
    } else {
        echo json_encode(array("error" => "Error when creating a question: " . $conn->error));
    }
} 
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
