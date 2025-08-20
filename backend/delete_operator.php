<?php
include 'db_connection.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => '');
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];

// First, delete the picture file if it exists
$sql_select = "SELECT picture_path FROM operators WHERE id = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $picture_path = 'uploads/' . $row['picture_path'];
    if (file_exists($picture_path) && !empty($row['picture_path'])) {
        unlink($picture_path);
    }
}
$stmt_select->close();

// Then, delete the record from the database
$sql = "DELETE FROM operators WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['message'] = 'Error: ' . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
