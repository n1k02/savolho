
<?php


session_start();

echo $_SESSION['id'];

// Set headers for CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");




// if (isset($_SESSION['user_id'])) {
//     // Пользователь вошел
//     $user_id = $_SESSION['user_id']; // Получаем ID пользователя из сессии
//     $user_name = $_SESSION['user_name']; // Получаем имя пользователя из сессии
// } else {
//     // Пользователь не вошел, выполните соответствующие действия, например, перенаправьте на страницу входа
//     echo "unauthorized";
//     exit();
// }


// mysqli connector
include_once '../connector.php';

$tbname = "questions";

function uploadImage($targetDir, $imageFile) {
    // Генерируем уникальное имя файла
    $uniqueName = uniqid() . '.' . pathinfo($imageFile['name'], PATHINFO_EXTENSION);
    $targetFile = $targetDir . $uniqueName;

    // Проверяем, является ли файл изображением
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (in_array($imageFileType, array('jpg', 'jpeg', 'png', 'gif'))) {
        if (move_uploaded_file($imageFile['tmp_name'], $targetFile)) {
            return $uniqueName; // Возвращаем уникальное имя сохраненного изображения
        } else {
            return "Error when saving image.";
        }
    } else {
        return "Supported image formats: JPG, JPEG, PNG, GIF";
    }
}

// check method
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $searchCategory = isset($_GET['searchCategory']) ? $_GET['searchCategory'] : null;
        $searchKeyword = isset($_GET['searchKeyword']) ? $_GET['searchKeyword'] : null;

        $sql = "SELECT * FROM " . $tbname;

        if ($searchCategory !== null) {
            $sql .= " WHERE categories LIKE '%$searchCategory%'";
        }

        // Добавить поиск по title и description, если указан searchKeyword
        if ($searchKeyword !== null) {
            if ($searchCategory !== null) {
                $sql .= " AND (title LIKE '%$searchKeyword%' OR description LIKE '%$searchKeyword%')";
            } else {
                $sql .= " WHERE (title LIKE '%$searchKeyword%' OR description LIKE '%$searchKeyword%')";
            }
        }

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
    } catch (Exception $e) {
        // Обработка исключения
        echo 'Произошла ошибка: ' . $e->getMessage();
    }
}
 elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Insert request
    $data = $_POST;
    $title = $data['title'];
    $description = $data['description'];
    $author = $data['author'];
    $categories = $data['categories'];

    $image_url = NULL;
    $targetDir = '../../src/questions/';

    if ($_FILES['image']) {
        $image_url = uploadImage($targetDir, $_FILES['image']);
    }

    $sql = "INSERT INTO $tbname (title, `description`, author, categories, image_url)
            VALUES ('$title', '$description', '$author', '$categories', '$image_url')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("message" => "Question created successfully"));
    } else {
        echo json_encode(array("error" => "Error when creating a question: " . $conn->error));
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
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
