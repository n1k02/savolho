<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = json_decode(file_get_contents("php://input"));

    $result = ['message' => 'All the data successfully processed'];

    header('Content-Type: application/json');
    echo json_encode($result);

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

     http_response_code(200);
     header('Content-Type: application/json');
     echo json_encode(['message' => 'responding to GET request']);

} else {
    http_response_code(405);
    echo json_encode(['error' => 'Request method is forbidden']);
}

?>