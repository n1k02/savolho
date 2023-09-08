
<?php

include_once '../connector.php';

$tbname = "categories";

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
}

$conn->close();
?>
